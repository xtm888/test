<?php

namespace App\Http\Controllers;

use App\Events\Purchase\ProductDisputeNewMessageSent;
use App\Exceptions\RedirectException;
use App\Exceptions\RequestException;
use App\Http\Requests\Cart\EditItemRequest;
use App\Http\Requests\Cart\MakePurchasesRequest;
use App\Http\Requests\Cart\NewItemRequest;
use App\Http\Requests\Payment\XmrWithdrawRequest;
use App\Http\Requests\PGP\NewPGPKeyRequest;
use App\Http\Requests\PGP\StorePGPRequest;
use App\Http\Requests\Profile\BecomeVendorRequest;
use App\Http\Requests\Profile\ChangeAddressRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\ChangePinRequest;
use App\Http\Requests\Profile\NewTicketMessageRequest;
use App\Http\Requests\Profile\NewTicketRequest;
use App\Http\Requests\Purchase\LeaveFeedbackRequest;
use App\Http\Requests\Purchase\MakeDisputeRequest;
use App\Http\Requests\Purchase\NewDisputeMessageRequest;
use App\Marketplace\Cart;
use App\Marketplace\Payment\MoneroPayment;
use App\Models\Dispute;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;

//use App\Http\Requests\Profile\ChangeLocalCurrencyRequest;
//use App\Http\Requests\Product\{NewBasicRequest,NewShippingRequest,NewDigitalRequest,NewImageRequest,NewOfferRequest,NewProductRequest,NewShippingOptionsRequest};

class ProfileController extends Controller
{
    /**
     * Middleware that says user must be authenticated and 2fa verified
     *
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verify_2fa');
    }

    public function index()
    {
        $user = auth()->user();
        $invites = $user->where('referred_by', $user->id)->get();
        $countInvites = count($invites);
        $monero = new MoneroPayment();
        $readyBalance = $monero->checkReadyBalance();
        $purchases = $user->purchases;
        return view('userCP.profile', compact('purchases', 'countInvites', 'readyBalance'));
    }

    public function settingsView()
    {
        return view('userCP.settings');
    }

    public function walletView()
    {
        $user = auth()->user();
        $monero = new MoneroPayment();
        $walletAddresses = $monero->listWallets();
        $balance = $monero->checkBalance();
        $readyBalance = $monero->checkReadyBalance();
        $histories = $monero->paymentHistory();
        return view('userCP.payment', compact('user', 'balance', 'walletAddresses', 'histories', 'readyBalance'));
    }

    public function withdrawXmr(XmrWithdrawRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
        }
        return redirect()->back();
    }


    public function invitesView()
    {
        $user = auth()->user();
        $code = $user->referral_code;
        $invites = $user->where('referred_by', $user->id)->get();
        $countInvites = count($invites);
        return view('userCP.invite', compact('invites', 'countInvites', 'code'));
    }

    /**
     * Banned view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function banned()
    {
        if (auth()->user()->isBanned())
            $until = auth()->user()->bans()->orderByDesc('until')->first()->until;
        else
            return redirect()->route('profile.index');

        return view('userCP.banned', [
            'until' => $until
        ]);
    }

    /**
     * Displays the page with the current pgp and the form to change pgp
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pgp()
    {
        return view('profile.pgp');
    }

    /**
     * Accepts the request for the new PGP key and generates data to confirm pgp
     *
     * @param NewPGPKeyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pgpPost(NewPGPKeyRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
        }

        return redirect()->route('profile.pgp.confirm');
    }

    /**
     * Displays the page to confirm new PGP request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pgpConfirm()
    {
        return view('userCP.PGP.pgp-confirm');
    }

    /**
     * Saves old key and sets new pgp key
     *
     * @param StorePGPRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function storePGP(StorePGPRequest $request)
    {
        try {
            $request->persist();
            session()->flash('success', 'You have successfully changed you PGP key.');
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('profile.settings');
    }

    /**
     * Page that displays old pgp keys
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function oldpgp()
    {
        return view('profile.oldpgp',
            [
                'keys' => auth()->user()->pgpKeys()->orderByDesc('created_at')->get(),
            ]
        );
    }

    /**
     * Accepts request for changing password
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
        }

        return redirect()->back();
    }

    public function changePin(ChangePinRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
        }

        return redirect()->back();
    }


    public function changeCurrency()
    {
        $validatedCurrency = request()->validate([
            'currency' => 'required|in:usd,euro,gbp,try',
        ]);

        $user = User::find(auth()->user()->id);
        $user->currency = $validatedCurrency['currency'];
        $user->save();

        return redirect()->back()->with('success', 'Currency Preference changed');
        // The blog post is valid...
    }

    public function addMainCategory()
    {
        $attributes = request()->validate([
            'type' => 'required',
            'mainname' => 'required'
        ]);

        $newSubCategory = new Category;
        $newSubCategory->type = $attributes['type'];
        $newSubCategory->name = $attributes['mainname'];
        $newSubCategory->save();

        return redirect()->back()->with('success', 'Category has been added');

    }



    /**
     * Add product to the users wishlist
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addRemoveWishlist(Product $product)
    {
        // Remove if it is added
        if (Wishlist::added($product, auth()->user())) {
            // removing
            Wishlist::getWish($product)->delete();
            session()->flash('success', 'Item Removed From Wishlist');
        } // add if it is not added
        else {
            $newWhish = new Wishlist([
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
            ]);
            session()->flash('success', 'Item Added to Wishlist');
            $newWhish->save();
        }

        return redirect()->back();
    }

    /**
     * Returns the page with the product wishlist
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wishlist()
    {
        return view('userCP.wishlist');
    }

    /**
     * Show the cart page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        return view('userCP.cart', [
            'items' => Cart::getCart()->items(),
            'numberOfItems' => Cart::getCart()->numberOfItems(),
            'totalSum' => Cart::getCart()->total(),
        ]);
    }

    /**
     * Add or edit item to cart
     *
     * @param NewItemRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(NewItemRequest $request, Product $product)
    {
        try {
            $request->persist($product);
            session()->flash('success', 'You have added an item!');

            return redirect()->route('profile.cart');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }

    public function editToCart(EditItemRequest $request, Product $product)
    {
        try {
            $request->persist($product);
            session()->flash('success', 'Saved!');

            return redirect()->route('profile.cart');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }

    /**
     * Clear cart and return back
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart()
    {
        session()->forget(Cart::SESSION_NAME);
        session()->flash('success', 'You have cleared your cart!');

        return redirect()->back();
    }

    /**
     * Remove $product from cart
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct(Product $product)
    {
        Cart::getCart()->removeFromCart($product);
        session()->flash('You have removed a product.');

        return redirect()->back();
    }

    /**
     * Return table with checkout
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        return view('cart.checkout', [
            'items' => Cart::getCart()->items(),
            'totalSum' => Cart::getCart()->total(),
            'numberOfItems' => Cart::getCart()->numberOfItems(),

        ]);
    }

    /**
     * Commit purchases from cart
     *
     * @param MakePurchasesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makePurchases(MakePurchasesRequest $request)
    {
        try {
            $request->persist();
        } catch (RequestException $e) {
            $e->flashError();
            return redirect()->back();
        }

        return redirect()->route('profile.purchases');
    }

    /**
     * Return all users purchases
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchases($state = '')
    {
        $purchases = auth()->user()->purchases()->orderByDesc('created_at')->paginate(20);

        if (array_key_exists($state, Purchase::$states))
            $purchases = auth()->user()->purchases()->where('state', $state)->orderByDesc('created_at')->paginate(20);

        return view('userCP.orders', [
            'purchases' => $purchases,
            'state' => $state,
        ]);
    }

    /**
     * Return view for encrypted message
     *
     * @param Purchase $purchase
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchaseMessage(Purchase $purchase)
    {
        return view('profile.purchases.viewmessage', [
            'purchase' => $purchase
        ]);
    }

//    /**
//     * See purchase details
//     *
//     * @param Purchase $purchase
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function purchase(Purchase $purchase)
//    {
//        return view('profile.purchases.purchase', [
//            'purchase' => $purchase
//        ]);
//    }

    /**
     * Show delivered confirmation page
     *
     * @param Purchase $purchase
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deliveredConfirm(Purchase $purchase)
    {
        return view('profile.purchases.confirmdelivered', [
            'backRoute' => redirect()->back()->getTargetUrl(),
            'purchase' => $purchase,
        ]);
    }

    /**
     * Mark Purchase as Delivered
     *
     * @param Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function markAsDelivered(Purchase $purchase)
    {
        try {
            $purchase->delivered();
        } catch (RequestException $e) {
            $e->flashError();
        }

//        return redirect()->route('profile.purchases.single', $purchase);
        return redirect()->route('profile.purchases');
    }

    /**
     * Returns view for confirming canceled
     *
     * @param Purchase $purchase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function confirmCanceled(Purchase $purchase)
    {
        return view('profile.purchases.confirmcanceled', [
            'backRoute' => redirect()->back()->getTargetUrl(),
            'sale' => $purchase
        ]);
    }

    /**
     * Make purchase as canceled
     *
     * @param Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function markAsCanceled(Purchase $purchase)
    {
        try {
            $purchase->cancel();
            session()->flash('success', 'You have successfully marked sale as canceled!');
        } catch (RequestException $e) {
            $e->flashError();
        }
        // if this logged user is vendor
        if ($purchase->isVendor())
//            return redirect()->route('profile.sales.single', $purchase);
            return redirect()->back();
//        return redirect()->route('profile.purchases.single', $purchase);
        return redirect()->back();
    }

    /**
     * Make Dispute for the given purchase
     *
     * @param MakeDisputeRequest $request
     * @param Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeDispute(MakeDisputeRequest $request, Purchase $purchase)
    {
        try {
            $purchase->makeDispute($request->message);
            session()->flash('success', 'You have made a dispute for this purchase!');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }

    /**
     * Send new dispute message to the dispute
     *
     * @param NewDisputeMessageRequest $request
     * @param Dispute $dispute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newDisputeMessage(NewDisputeMessageRequest $request, Dispute $dispute)
    {
        try {
            $dispute->newMessage($request->message);
            event(new ProductDisputeNewMessageSent($dispute->purchase, auth()->user()));
            session()->flash('success', 'You have successfully posted new message for dispute!');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }


    public function newDisputeMessageView(Purchase $purchase)
    {
        if (auth()->check() && (auth()->user()->id == $purchase->buyer->id || auth()->user()->id == $purchase->vendor->id || auth()->user()->isAdmin())) {
            return view('components.dispute', compact('purchase'));
        } else {
            abort(404);
        }
    }

    public function VendorDisputeMessageView(Purchase $purchase)
    {
        if (auth()->check() && (auth()->user()->id == $purchase->buyer->id || auth()->user()->id == $purchase->vendor->id || auth()->user()->isAdmin())) {
            return view('components.dispute', compact('purchase'));
        } else {
            abort(404);
        }
    }

    /**
     * Leaving feedback
     *
     * @param LeaveFeedbackRequest $request
     * @param Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leaveFeedback(LeaveFeedbackRequest $request, Purchase $purchase)
    {
        try {
            $request->persist($purchase);
            session()->flash('success', 'You have left your feedback!');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->route('profile.purchases', $purchase);
    }

    public function leaveFeedbackView(Purchase $purchase)
    {
        return view('userCP.Feedback.leave-feedback', compact('purchase'));
    }

    /**
     * Change vendor's address
     *
     * @param ChangeAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeAddress(ChangeAddressRequest $request)
    {
        try {
            auth()->user()->setAddress($request->address, $request->coin);
            session()->flash('success', 'You have successfully changed your address!');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }

    /**
     * Remove address of the logged user with given $id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAddress($id)
    {
        try {
//            $address = Address::findOrFail($id);
            // Check for number of addresses for coin
//            if(auth() -> user() -> numberOfAddresses($address -> coin) <= 1)
//                throw new RequestException('You must have at least one address for each coin!');
//
            auth()->user()->addresses()->where('id', $id)->delete();
            session()->flash('success', 'You have successfully removed your address!');
        } catch (RequestException $e) {
            $e->flashError();
        }

        return redirect()->back();
    }

    /**
     * Showing all tickets
     *
     * @param Ticket|null $ticket
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tickets(Ticket $ticket = null)
    {
        // Tickets
        if (!is_null($ticket)) {
            $replies = $ticket->replies()->orderByDesc('created_at')->paginate(config('marketplace.products_per_page'));
        } else {
            $replies = collect(); // empty collection
        }

        return view('userCP.support', [
            'replies' => $replies,
            'ticket' => $ticket
        ]);
    }

    /**
     * Opens new Ticket form
     *
     * @param NewTicketRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function newTicket(NewTicketRequest $request)
    {
        try {
            $newTicket = Ticket::openTicket($request->title);
            TicketReply::postReply($newTicket, $request->message);

            return redirect()->route('profile.tickets', $newTicket);
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @throws \Throwable
     */
    public function newTicketMessage(Ticket $ticket, NewTicketMessageRequest $request)
    {
        try {
            TicketReply::postReply($ticket, $request->message);
        } catch (RequestException $e) {
            Log::error($e);
            session()->flash('errormessage', $e->getMessage());
        }
        return redirect()->back();
    }

}
