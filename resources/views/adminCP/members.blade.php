<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        <div class="max-w-screen-2xl mx-auto">
            <div class="flex flex-col ">
                <div class="overflow-x-auto 2xl:overflow-hidden sm:-mx-6 lg:-mx-8 ">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        USERNAME
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        REFERRED BY
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        REG DATE
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        LAST SEEN
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        LAST ACTION
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        STATUS
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            @if($user->isVendor())
                                                <a href="{{route('vendor.show', $user->username)}}"
                                                   class="p-1 dark:bg-green-900 dark:text-gray-300 rounded-md">{{$user->username}}</a>
                                            @else
                                                <a href="{{route('user.show', $user->username)}}"
                                                   class="p-1 dark:bg-gray-600 dark:text-gray-300 rounded-md">{{$user->username}}</a>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if($user->hasReferredBy())
                                                {{$user->referredByUsername()}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{$user->created_at}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{$user->last_seen}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{$user->last_action}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if($user->isAdmin())
                                                <span
                                                    class="p-2 dark:bg-red-800 dark:text-gray-300 rounded">Admin</span>
                                            @else
                                                Member
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <div class="flex flex-row gap-6">
                                            @if(!$user->isBanned())
                                                <a href="{{route('admin.user.ban',$user)}}"
                                                   class="p-2 dark:bg-stone-900 dark:text-gray-300 rounded">Ban</a>
                                            @else
                                                <a href="{{route('admin.ban.remove',$user)}}"
                                                   class="p-2 dark:bg-gray-300 dark:text-stone-900 rounded">Remove
                                                    Ban</a>
                                            @endif

                                            @if(!$user->isAdmin())
                                                <a href="{{route('admin.user.makeadmin',$user)}}"
                                                   class="p-2 dark:bg-rose-400 dark:text-gray-900 rounded">Make Admin</a>
                                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
