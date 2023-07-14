<x-layout>
    <x-slot name="title">
        Cart
    </x-slot>
    <x-slot name="content">
        <x-userCP.tabmenu/>
        <style>
            .no-spinners {
                -moz-appearance: textfield;
            }

            .no-spinners::-webkit-outer-spin-button,
            .no-spinners::-webkit-inner-spin-button {
                margin: 0;
                -webkit-appearance: none;
            }
        </style>

        <div class="container px-5 pt-24 mx-auto">
            <div class="mx-auto w-4/12 md:w-2/12 -mt-24 -mb-12">
                <x-svg.usercp-cart/>
            </div>
        </div>

        @if(!empty($items))
            <section>
                <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
                    <ul class="space-y-4">
                        @foreach($items as $productId => $item)
                            <form action="{{ route('profile.cart.edit', \App\Models\Product::find($productId)) }}"
                                  method="POST">
                                @csrf
                                <li
                                    class="p-4 border-2 border-gray-400 sm:items-center sm:justify-between sm:flex"
                                >
                                    <div class="flex items-center sm:flex-1">
                                        <a href="" class="flex-shrink-0 block">
                                            <img
                                                class="w-36 h-36"
                                                src="/storage/{{$item->offer->product->frontImage()->image}}"
                                                alt=""
                                            />
                                        </a>

                                        <div class="max-w-xl ml-6">
                                            <a href="{{route('product.show',$item -> offer -> product->id)}}" class="text-lg font-medium">
                                                {{ $item -> offer -> product -> name }}
                                            </a>

                                            <p class="mt-1 text-xs text-gray-500">
                                                Seller: {{ $item -> vendor -> user -> username }}</p>

                                            <p class="mt-4 font-medium text-gray-700">
                                                <span>{{$item -> offer -> product->id}}</span>
                                            </p>
                                        </div>
                                    </div>


                                    <div class="mt-4 lg:items-center lg:mt-0 lg:flex flex-col">
                                        <div class=" py-2">
                                            @if($item -> offer -> product -> isPhysical())

                                                <select name="shipping" id="shipping"
                                                        class="appearance-none px-2 dark:text-black">
                                                    @foreach($item -> offer -> product -> specificProduct() -> shippings as $shipping)
                                                        <option value="{{ $shipping -> id }}"
                                                                @if($shipping -> id == $item -> shipping -> id) selected @endif>
                                                        @if (auth()->user())
                                                            @if (auth()->user()->currency == 'usd')
                                                               {{$shipping->name . ' ' . '$' . $shipping ->price}}
                                                            @endif @if(auth()->user()->currency == 'euro')
                                                               {{$shipping->name . ' ' . '€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($shipping->price),2)}}
                                                            @endif @if(auth()->user()->currency == 'gbp')
                                                               {{$shipping->name . ' ' . '£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($shipping->price),2)}}
                                                            @endif @if(auth()->user()->currency == 'try')
                                                               {{$shipping->name . ' ' . '₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($shipping->price),2)}}
                                                            @endif
                                                        @else
                                                            {{$shipping ->name . ' ' . $shipping ->price . '$'}}
                                                        @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span class="badge badge-info ml-4">Digital delivery</span>
                                            @endif
                                        </div>

                                        <div class="flex justify-between py-2 pb-4 ">
                                            <p>
                                                Quantity:
                                                @if($item -> offer -> product -> isPhysical())
                                                    <input type="number" name="amount" id="amount" class="text-center text-black w-10 no-spinners"
                                                           value="{{ $item -> quantity }}"> {{ $item -> offer -> product -> count_type }}
                                                @else
                                                    {{ $item -> quantity . ' ' . $item -> offer -> product -> count_type}}
                                                @endif
                                            </p>
                                        </div>

                                        <div class="flex flex-shrink-0">
                                            @if($item -> offer -> product -> isPhysical())
                                                <button type="submit"
                                                    class="block w-full px-5 py-3 mt-4 text-sm font-medium tracking-widest text-green-600 uppercase border-2 border-green-600 lg:ml-4 lg:mt-0 hover:bg-green-600 hover:text-white"
                                                >
                                                    Save
                                                </button>
                                            @endif


                                            <a
                                                href="{{route('profile.cart.remove',$productId)}}"
                                                class="block w-full px-5 py-3 mt-4 text-sm font-medium tracking-widest text-red-600 uppercase border-2 border-red-600 lg:ml-4 lg:mt-0 hover:bg-red-600 hover:text-white"
                                            >
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                                </svg>
                                            </a>
                                        </div>

                                    </div>
                            </form>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <x-userCP.cart.checkout-card :items="$items" :totalSum="$totalSum"/>
            </section>
        @else
            <div class="flex w-full h-96">
                <div class="m-auto">
                    <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                        Your cart is empty!
                    </p>
                </div>
            </div>
        @endif
    </x-slot>
</x-layout>
