<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        <div class="flex flex-col text-center">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="inline-block py-2 min-w-fit sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-fit">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    LIST_ID
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    PRODUCT NAME
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    VENDOR
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    LISTED_AT
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    STATUS
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <!-- The button to open modal -->
                                        <label for="view{{$product -> id}}" class="btn modal-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                                                 viewBox="0 0 24 24" width="36px" class="text-blue-100"
                                                 fill="currentColor">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M18.19,12.44l-3.24-1.62c1.29-1,2.12-2.56,2.12-4.32c0-3.03-2.47-5.5-5.5-5.5s-5.5,2.47-5.5,5.5c0,2.13,1.22,3.98,3,4.89 v3.26c-2.15-0.46-2.02-0.44-2.26-0.44c-0.53,0-1.03,0.21-1.41,0.59L4,16.22l5.09,5.09C9.52,21.75,10.12,22,10.74,22h6.3 c0.98,0,1.81-0.7,1.97-1.67l0.8-4.71C20.03,14.32,19.38,13.04,18.19,12.44z M17.84,15.29L17.04,20h-6.3 c-0.09,0-0.17-0.04-0.24-0.1l-3.68-3.68l4.25,0.89V6.5c0-0.28,0.22-0.5,0.5-0.5c0.28,0,0.5,0.22,0.5,0.5v6h1.76l3.46,1.73 C17.69,14.43,17.91,14.86,17.84,15.29z M8.07,6.5c0-1.93,1.57-3.5,3.5-3.5s3.5,1.57,3.5,3.5c0,0.95-0.38,1.81-1,2.44V6.5 c0-1.38-1.12-2.5-2.5-2.5c-1.38,0-2.5,1.12-2.5,2.5v2.44C8.45,8.31,8.07,7.45,8.07,6.5z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </label>

                                        <!-- Put this part before </body> tag -->
                                        <input type="checkbox" id="view{{$product -> id}}" class="modal-toggle">
                                        <div class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">Product List ID</h3>
                                                <p class="py-4 select-all">{{$product->id}}</p>
                                                <div class="modal-action">
                                                    <label for="view{{$product -> id}}" class="btn">OK!</label>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{$product->name}}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        @if($product->user)
                                            {{$product->user->username}}
                                        @else
                                            {{$product->user}}
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{$product->created_at}}
                                    </td>

                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        @if($product->active == 1)
                                            <span
                                                class="p-0.5 rounded-xl dark:bg-green-900 dark:text-white">Active</span>
                                        @else
                                            <span
                                                class="p-0.5 rounded-xl dark:bg-red-900 dark:text-white">Passive</span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">


                                        <div class="btn-group block">

                                            <a href="{{ route('admin.product.edit', $product -> id) }}"
                                               class="btn">Edit</a>


                                        {{--                                <a href="" class="btn">Unlist</a>--}}
                                        <!-- The button to open modal -->
                                            <label for="delete{{$product -> id}}"
                                                   class="btn modal-button">Delete</label>

                                            <!-- Put this part before </body> tag -->
                                            <input type="checkbox" id="delete{{$product -> id}}" class="modal-toggle">
                                            <div class="modal">
                                                <div class="modal-box">
                                                    <h3 class="font-bold text-lg">Are you sure?!</h3>
                                                    <p class="py-4">Product going to be deleted!</p>

                                                    <div class="modal-action">
                                                        <a href="{{ route('admin.product.delete', $product -> id) }}"
                                                           class="btn">Delete</a>
                                                        <label for="delete{{$product -> id}}" class="btn">DONT
                                                            DELETE!</label>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                    <a href="{{route('profile.vendor.product.clone.post',$product)}}"--}}
                                            {{--                                       class="btn">Clone</a>--}}

                                            <a href="{{ route('product.show', $product -> id) }}" class="btn">View</a>
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

    </x-slot>
</x-layout>
