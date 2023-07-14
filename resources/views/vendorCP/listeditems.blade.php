<x-layout>
    <x-slot name="content">
        <x-vendorCP.tabmenu/>

        <div class="flex mt-12">
            <div class="mx-auto overflow-x-auto rounded border dark:border-gray-500">
                <table class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>LIST ID</th>
                        <th>ITEM NAME</th>
                        <th>CATEGORY</th>
                        <th>FROM-TO</th>
                        <th>STOCK</th>
                        <th>SALES</th>
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row 1 -->
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <!-- The button to open modal -->
                                <label for="view{{$product -> id}}" class="btn modal-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                                         viewBox="0 0 24 24" width="36px" class="text-blue-100" fill="currentColor">
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
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>
                                @if($product->isDigital())
                                    <span class="badge">Digital</span>
                                @else
                                    {{$product->physical->country_from . '->' . $product->physical->countries}}
                                @endif
                            </td>
                            <td>{{$product->quantity . ' ' . $product->count_type}}</td>
                            <td>{{ $product -> getOrdersAmount() }} {{$product->count_type}}</td>
                            <td>
                                <div class="btn-group block">

                                    <a href="{{ route('profile.vendor.product.edit', $product -> id) }}"
                                       class="btn">Edit</a>


                                {{--                                <a href="" class="btn">Unlist</a>--}}
                                <!-- The button to open modal -->
                                    <label for="delete{{$product -> id}}" class="btn modal-button">Delete</label>

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="delete{{$product -> id}}" class="modal-toggle">
                                    <div class="modal">
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">Are you sure?!</h3>
                                            <p class="py-4">Product going to be deleted!</p>

                                            <div class="modal-action">
                                                <a href="{{ route('profile.vendor.product.remove', $product -> id) }}"
                                                   class="btn">Delete</a>
                                                <label for="delete{{$product -> id}}" class="btn">DONT DELETE!</label>
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
    </x-slot>
</x-layout>
