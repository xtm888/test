<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>


        {{--        <div class="container mx-auto px-6 py-8">--}}
        {{--            <h3 class="font-bold border-b-2 border-r-2 max-w-fit border-black px-1">Total Sales: 21</h3>--}}
        {{--        </div>--}}

        @if(count($purchases))
            <div class="flex flex-col text-center">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="inline-block py-2 min-w-fit sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-fit">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        ORDER ID
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        AMOUNT
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        ITEM
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        BUYER
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        DATE
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        PAID
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        STATUS
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <!-- Product -->
                                @foreach($purchases as $purchase)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$purchase->short_id}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <p class="p-1 dark:bg-sky-900 dark:text-white rounded-xl"> {{ $purchase -> quantity }} </p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $purchase -> offer -> product -> name }}
                                            by {{ $purchase -> vendor -> user -> username }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <p class="p-1 dark:bg-yellow-900 dark:text-white rounded-xl">{{ $purchase -> buyer -> username }}</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{$purchase->created_at}}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{$purchase -> to_pay +0}} XMR
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ ucfirst($purchase -> state) }}</span>
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
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        No Sale Exists Yet!
                    </p>
                </div>
            </div>
        @endif


    </x-slot>
</x-layout>
