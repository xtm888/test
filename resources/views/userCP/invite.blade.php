<x-layout>
    <x-slot name="title">
        Invites
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>

        <div class="container px-5 pt-24 mx-auto">
            <div class="mx-auto w-4/12 md:w-3/12 -mt-24 -mb-8">
                <x-svg.usercp-invites/>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
{{--            <div class="py-8">--}}
{{--                <h3 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1">Total--}}
{{--                    Invited: {{$countInvites}}</h3>--}}
{{--            </div>--}}

            <div class="p-4 w-full mx-auto mt-10">
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-md text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Referal Link
                    </span>
                    <p class="text-center select-all rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-md border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        {{ url('/') . '/signup/' . $code }}</p>
                </div>
            </div>

            @if($countInvites)
            <div class="flex flex-col text-center">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="inline-block py-2 min-w-fit sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-fit">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        USER
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        EARNED
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invites as $invited)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{Str::mask($invited->username,'*',2,5)}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            0.03 XMR
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="flex w-full h-64">
                    <div class="m-auto">
                        <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-red-900 dark:shadow-red-900">
                            404notfound - Invite Your Friends and Earn With Us!
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-slot>
</x-layout>
