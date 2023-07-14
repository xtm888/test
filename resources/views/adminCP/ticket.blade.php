<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>
        <div
            class="flex flex-col max-w-2xl mx-auto items-center text-center p-12 border border-dashed rounded-xl dark:border-yellow-300">
            <div class="min-w-full">
                <h3 class="mb-2">Ticket: {{ $ticket -> title }}</h3>
                <hr>
                @if(!$ticket -> solved)
                    <form method="POST" action="{{ route('profile.tickets.message.new', $ticket) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="text"><h4>New ticket message:</h4></label>
                            <textarea class="w-full p-1.5" name="message" id="title" rows="8"
                                      placeholder="Enter ticket content"></textarea>
                            <small class="form-text text-muted">Post new message!</small>
                        </div>

                        <div class="form-group text-right flex justify-between mt-2">
                            @hasAccess('tickets')
                            <a href="{{ route('admin.tickets.solve', $ticket) }}" class="btn btn-warning">
                                Solve Ticket
                            </a>
                            @endhasAccess
                            <button type="submit" class="btn btn-outline-success">
                                Post message
                            </button>
                        </div>
                    </form>
                @else
                    <div class="alert text-center alert-success mt-3">
                        This ticket is solved!
                        @hasAccess('tickets')
                        <a href="{{ route('admin.tickets.solve', $ticket) }}"
                           class="btn btn-outline-danger btn-sm">Unsolve</a>
                        @endhasAccess
                    </div>
                @endif
                @foreach($replies as $reply)
                    <div class="flex flex-col mt-2">
                        <div class="border rounded-xl {{$reply->user->username == auth()->user()->username ? 'dark:bg-sky-900' : 'dark:bg-orange-900' }} p-2 my-2">
                            <div class="card-body">
                                <p class="card-text">
                                    {{ $reply -> text }}
                                </p>
                            </div>
                            <div class="card-footer text-right py-1">
                                <small><span class="text-muted">{{ $reply -> time_passed }}</span>
                                    by <strong>{{ $reply -> user -> username }}</strong></small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-layout>
