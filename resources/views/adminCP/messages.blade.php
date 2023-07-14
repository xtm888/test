<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>
        <div class="max-w-6xl mx-auto ">
            @if(count($conversations))
            <div class="overflow-x-auto ">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>Users</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    @foreach($conversations as $conversation)
                        <tbody>
                        <!-- row 1 -->
                        <tr>
                            <td>
                                @foreach($conversation->users as $user)
                                    {{$user->username}}
                                    @if(!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$conversation->subject}}</td>

                            <td>
                                <!-- The button to open modal -->
                                    <label for="delete{{$conversation -> id}}" class="btn modal-button">Read Messages</label>

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="delete{{$conversation -> id}}" class="modal-toggle">
                                    <div class="modal">
                                        <div class="modal-box">
                                            @foreach($conversation->messages->sortByDesc('created_at') as $message)
                                            <h3 class="font-bold text-lg">By {{$message->user->username}} ({{$message->created_at->diffForHumans()}})</h3>
                                            <p class="pb-4">{{$message->body}}</p>
                                            @endforeach

                                            <div class="modal-action">
                                                <label for="delete{{$conversation -> id}}" class="btn">DONE!</label>
                                            </div>
                                        </div>
                                </div>

                            </td>

                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            @else
                <div class="flex w-full h-96">
                    <div class="m-auto">
                        <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                            No User Conversation Is Exists Yet!
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-slot>
</x-layout>
