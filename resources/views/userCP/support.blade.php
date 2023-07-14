<x-layout>
    <x-slot name="title">
        Support
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="max-w-6xl mx-auto p-6 my-6">
            <div class="grid grid-cols-11 gap-6">
                <div class="lg:col-span-4 col-span-11">
                    <div class="border p-6 text-center dark:bg-gray-800">
                        <a href="{{route('profile.tickets')}}"
                           class="border-2 dark:border-slate-800 p-2 text-xl rounded-md dark:bg-slate-600 flex  justify-center gap-4">

                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                 fill="currentColor" class="mt-0.5">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path
                                    d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-8.5-2h3v-3.5H17v-3h-3.5V7h-3v3.5H7v3h3.5z"/>
                            </svg>
                            Create
                            New Ticket</a>
                    </div>
                    <div class="border border-b p-4">
                        @if(!auth() -> user() -> tickets() -> exists())
                            <p class="text-xl">You have no tickets..</p>
                        @else
                            <ul class="overflow-y-auto space-y-2 min-h-[240px] max-h-[500px]">
                                @foreach(auth() -> user() -> tickets as $currTicket)
                                    <li class="flex"
                                        style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">

                                        <a href="{{ route('profile.tickets', $currTicket) }}"
                                           class="font-bold">
                                            <div
                                                class="leading-relaxed rounded-sm p-2 @if($currTicket == $ticket)dark:bg-yellow-600 @else hover:dark:bg-gray-600 @endif">
                                                > {{ $currTicket -> title }}
                                                @if($currTicket -> solved)
                                                    <span class="text-green-700">Solved</span>
                                                @else
                                                    @if($currTicket -> answered)
                                                        <span class="badge badge-warning">Answered</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-7 col-span-11">
                    @if(!$ticket)
                        <div class="font-sans antialiased">
                            <div class="w-full" style="">
                                <div class="">
                                    <form method="POST" action="{{ route('profile.tickets.new') }}">
                                        @csrf
                                        <div class=" mx-auto bg-white rounded dark:bg-gray-700 shadow-2xl">
                                            <div
                                                class="py-4 px-8 text-black  dark:text-yellow-600  text-xl border-b border-dotted border-grey-lighter">
                                                Create A
                                                Support Ticket
                                            </div>
                                            <div class="py-4 px-8">
                                                <x-form.input name="title"/>
                                                <x-form.textarea name="message"/>

                                                <div class="flex items-center justify-end mt-8">
                                                    <button
                                                        class="btn btn-secondary"
                                                        type="submit">
                                                        Create Ticket
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="font-sans antialiased bg-grey-lightest">
                            <div class="w-full bg-grey-lightest" style="">
                                <div class="">
                                    <div class=" mx-auto bg-white  dark:bg-gray-700 rounded shadow-2xl">
                                        <div
                                            class="py-4 px-8 text-black dark:text-yellow-600 text-xl border-b border-grey-lighter">
                                            Ticket: {{ $ticket -> title }}
                                        </div>
                                        <div class="py-4 px-8">
                                            <div
                                                class="min-h-[120px] max-h-[450px] overflow-y-auto flex flex-col-reverse">
                                                @foreach($replies as $reply)
                                                    <div
                                                        class="my-2 border dark:border-gray-600 dark:bg-gray-800 border-dotted rounded-md p-4 ">
                                                        <div class="">
                                                            <p class="">
                                                                {{ $reply -> text }}
                                                            </p>
                                                        </div>
                                                        <div class="card-footer text-right py-1">
                                                            <small><span
                                                                    class="text-muted">{{ $reply -> time_passed }}</span>
                                                                by
                                                                <strong>{{ $reply -> user -> username }}</strong></small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="flex flex-col   mt-8">
                                                @if(!$ticket -> solved)
                                                    <form method="POST"
                                                          action="{{ route('profile.tickets.message.new', $ticket) }}">
                                                        @csrf

                                                        <div class="">
                                                            <x-form.textarea name="message"
                                                                             placeholder="Enter ticket content"
                                                                             rows="6"
                                                                             labelhidden="true"></x-form.textarea>
                                                        </div>

                                                        <div class="flex-col text-right">

                                                            @hasAccess('tickets')
                                                            <a href="{{ route('admin.tickets.solve', $ticket) }}"
                                                               class="btn btn-warning">
                                                                Solve Ticket
                                                            </a>
                                                            @endhasAccess
                                                            <button
                                                                class="btn btn-primary"
                                                                type="submit">
                                                                Post Message
                                                            </button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="alert text-center alert-success">
                                                        This ticket is solved!
                                                        @hasAccess('tickets')
                                                        <a href="{{ route('admin.tickets.solve', $ticket) }}"
                                                           class="btn btn-outline-danger btn-sm">Unsolve</a>
                                                        @endhasAccess
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>


    </x-slot>
</x-layout>
