<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        {{--        <div class="container mx-auto px-6 py-8">--}}
        {{--            <h3 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1">Total Tickets: 21</h3>--}}
        {{--        </div>--}}

        @if(count($tickets))
            <div class="flex flex-col text-center">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="inline-block py-2 min-w-fit sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-fit">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        TITLE
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        OPENED BY
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        TIME
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        STATUS
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        ACTION
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <!-- Product -->
                                @foreach($tickets as $ticket)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="{{ route('admin.tickets.view', $ticket) }}"
                                               class="mt-1">{{ $ticket -> title }}</a>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $ticket -> user -> username }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $ticket -> time_passed }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if($ticket -> solved)
                                                <span class="badge badge-success">Solved</span>
                                            @elseif($ticket -> answered)
                                                <span class="badge badge-warning">Answered</span>
                                            @else
                                                <span class="badge badge-error">Waiting Answer</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if(!$ticket -> solved)
                                                <a class="badge badge-primary"
                                                   href="{{route('admin.tickets.view',$ticket)}}">REPLY</a>
                                            @else
                                                <a class="badge badge-secondary"
                                                   href="{{route('admin.tickets.view',$ticket)}}">VIEW</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 mb-3">
                    <div class="col">
                        <form action="{{route('admin.tickets.remove')}}" method="post">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-outline-info" name="type" value="solved">Remove solved
                                tickets
                            </button>
                            <button type="submit" class="btn btn-outline-info" name="type" value="all">Remove all
                                tickets
                            </button>

                            <div
                                class="inline-block mb-3 mt-2 border border-black dark:border-white dark:border-opacity-30 rounded px-1">
                                <input type="text" class="rounded p-2" placeholder="Older than (Days)" name="days"
                                       aria-label="Days" aria-describedby="basic-addon2">
                                <div class="inline-block">
                                    <button class="btn btn-outline-info" type="submit" name="type"
                                            value="orlder_than_days">Remove all
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        No Ticket is Exists!
                    </p>
                </div>
            </div>
        @endif


    </x-slot>
</x-layout>
