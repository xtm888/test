<x-layout>
    <x-slot name="title">
        Notifications
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="container px-5 pt-24 mx-auto">
            <div class="mx-auto w-4/12 md:w-1/12 -mt-24 -mb-12">
                <x-svg.usercp-notification/>
            </div>
        </div>

        <div class="max-w-5xl mx-auto min-h-[350px]">

            @if($notifications->count())
                <div class="mt-14 mx-4">
                    <div class="overflow-x-auto border dark:border-yellow-500 dark:border-opacity-60 rounded-sm p-2">
                        <table class="table table-zebra w-full">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Notification</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            @foreach($notifications as $notification)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$notification->description}}</td>
                                    <td>{{$notification->created_at->diffForHumans()}}</td>
                                    <td>
                                        @if($notification->getRoute() !== null )
                                            <a href="{{route($notification->getRoute(),$notification->getRouteParams())}}"
                                               class="p-2 mr-2 mt-2 border rounded-md"> View</a>
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{route('profile.notifications.delete')}}" method="post">
                    @csrf
                    <div class="text-right mr-4 mt-6">
                        <button type="submit"
                                class="p-2 m-2  dark:bg-gray-700 dark:text-gray-100 border rounded-md"> Delete
                            notifications
                        </button>
                    </div>
                </form>

                <div class="mt-3">
                    {{$notifications->links()}}
                </div>


        </div>
        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        You don't have any notifications yet.
                    </p>
                </div>
            </div>
        @endif

    </x-slot>
</x-layout>
