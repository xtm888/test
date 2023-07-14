<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestException;
use App\Http\Requests\Profile\DecryptMessagesRequest;
use App\Http\Requests\Profile\NewConversationRequest;
use App\Http\Requests\Profile\NewMessageRequest;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;


class MessageController extends ProfileController
{
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        // Must be logged in
//        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Returns the view with the all conversations and view of the one conversation if it is set
     *
     * @param Conversation|null $conversation
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function messages(Conversation $conversation = null, Request $request)
    {


        //    if (!is_null($conversation)) {
        if (($conversation)->exists) {
            // only people in chat can view conversation
            $this->authorize('view', $conversation);
            // Mark messages as read
            $conversation->markMessagesAsRead($conversation->id);
        }

//        $other_party_from_url = $request->otherParty;
//        $other_party_from_session = session()->get('new_conversation_other_party');
//        if (!$other_party_from_session) {
//            $new_conversation_other_party = $other_party_from_url;
//        } else {
//            session()->forget('new_conversation_other_party');
//            $new_conversation_other_party = $other_party_from_session;
//        }
//        return view('userCP.messages', [
//            'new_conversation_other_party' => $new_conversation_other_party,
//            'conversation' => $conversation,
//            'usersConversations' => auth()->user()->conversations()->orderByDesc('updated_at')->take(10)->get(), // list of users conversations
//            'conversationMessages' => $conversation?->messages()->orderByDesc('created_at')
//                ->paginate(config('marketplace.products_per_page')), // messages of the conversation
//        ]);

        //$user = auth()->user();

//        $conversations = auth()->user()->conversations->sortByDesc('updated_at');
        return view('userCP.messages', compact('conversation'));

    }

    /**
     *  List of all paginated Conversations
     *
     */
    public function listConversations()
    {
        return view('profile.conversations', [
            'usersConversations' => auth()->user()->conversations()->orderByDesc('updated_at')->paginate(config('marketplace.products_per_page')),
        ]);
    }

    public function startConversationView()
    {

        if (\request()->username == auth()->user()->username)
            return redirect()->back()->with('errormessage' , 'You cant send pm yourself.');
        if (\request()->username == null)
            abort(404);
        return view('userCP.Messages.create-message');
    }

    public function startConversation(NewConversationRequest $request)
    {

        $user = auth()->user();

        $receiverUserId = User::where('username', $request->username)->value('id');

        if ($user->id == $receiverUserId) {
            return back()->with('errormessage', 'You can not send message yourself');
        }

        $createdConversation = $user->conversations()->create([
            'subject' => $request->title,
            'isSystem' => 0
        ]);

        $createdConversation->messages()->create([
            'user_id' => $user->id,
            'body' => $request->message
        ]);

        $createdConversation->users()->attach($receiverUserId, ['unRead' => 1]);

        return redirect()->route('profile.messages')->with('success', 'The Message Has Been Sent!');
    }

    /**
     * Request for the new message, POST
     * Response is redirect back
     *
     * @param NewMessageRequest $request
     * @param Conversation $conversation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function newMessage(NewMessageRequest $request, Conversation $conversation)
    {
        try {
//            $this->authorize('update', $conversation);
           // $conversation->updateTime(); // update time of the conversation
            $request->persist($conversation); // Persist the request
            session()->flash('success', 'New message has been posted');
        } catch (RequestException $e) {
            $e->flashError();
        }

        // Redirect to conversation
        return redirect()->route('profile.messages', $conversation);


    }

    /**
     * Shows page that requests password to decrypt rsa key
     */
    public function decryptKeyShow(Request $request)
    {
        return view('userCP.Messages.messagekey');
    }

    /**
     * Shows page that requests password to decrypt rsa key
     */
    public function decryptKeyPost(DecryptMessagesRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            $e->flashError();
            return redirect()->back();
        }
        return redirect()->route('profile.messages');

    }
}
