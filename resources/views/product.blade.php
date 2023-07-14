<x-layout>
    <x-slot name="title">
        {{$product->name}}
    </x-slot>
    <x-slot name="content">

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

        <div class="max-w-6xl mx-auto">

            <div class="mt-14 flex flex-col lg:flex-row w-full justify-between px-1">

                {{--                DIV FOR PRODUCT IMAGE-DESC-VIDEO--}}
                <div class="flex flex-col w-full lg:w-3/5 px-2">
                    <h1 class="text-2xl font-bold lg:text-3xl">
                        {{$product->name}}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Item List Number: #{{$product->id}}
                    </p>

                    <div
                        class="carousel w-full mt-4 border rounded-3xl dark:border-blue-800 dark:border-opacity-30 shadow-2xl dark:shadow-blue-800 ">
                        @foreach($product->images->all() as $image)
                            <div id="slide{{$loop->iteration}}"
                                 class="carousel-item relative w-full h-[500px] scroll-mt-20">
                                <img class="w-full object-cover" src="/storage/{{$image->image}}">
                                <div
                                    class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                    <a href="@if(!$loop->first){{'#slide'.$loop->iteration-1}}@else {{'#slide'.$loop->count}} @endif"
                                       class="btn btn-circle">❮</a>
                                    <a href="@if(!$loop->last){{'#slide'.$loop->iteration+1}}@else #slide1 @endif"
                                       class="btn btn-circle">❯</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full mt-12">
                        <h2 class="mx-auto w-fit border px-2 py-1 rounded-md dark:border-gray-600 dark:bg-gray-800 text-green-300">
                            DESCRIPTION</h2>
                        <p class="text-lg mt-2 text-green-100">{{$product->description}}</p>
                    </div>

                    <div class="w-full mt-6">
                        <h2 class="mx-auto w-fit border px-2 py-1 rounded-md dark:border-gray-600 dark:bg-gray-800 text-pink-300">
                            RULES</h2>
                        <p class="text-lg mt-2 text-pink-100">{{$product->rules}}</p>
                    </div>

                    @if($product->video)
                        @php
                            $videoExtension = explode(".", $product->video->video)
                        @endphp
                        <div class="mt-4 mx-auto pt-6">
                            <video width="920" height="740" controls>
                                <source src="/storage/{{$product->video->video}}"
                                        type="video/{{$videoExtension[1]}}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif

                </div>

                {{--                DIV FOR OTHERPART--}}
                <div class="lg:w-2/5 flex flex-col lg:pl-12 lg:mt-0 mt-6">
                    <div class="space-y-4 lg:top-0 lg:sticky">
                        <fieldset>
                            <legend class="text-lg font-bold">
                                Seller
                            </legend>

                            <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4">
                                <a href="/vendor/{{$product->user->username}}" class="text-xl">
                                    <p class="block">
                                        {{$product->user->username}} <span
                                            class="text-sm text-red-300">({{$product->user->vendor->countFeedback()}} rev)</span>
                                    </p></a>
                                @if($product->user->vendor->onVacation)
                                    <div>
                                        <p class="p-1.5 my-2 rounded-md w-fit text-lg dark:bg-red-300 dark:text-gray-900">
                                            Vendor is on vacation</p>
                                    </div>
                                @endif
                                <div class="flex flex-col mt-2 -ml-0.5 text-md">
                                    @if($product->user->vendor->countFeedback() < 1)
                                        <div class="flex flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                                 width="24px" fill="currentColor">
                                                <rect fill="none" height="24" width="24"/>
                                                <g>
                                                    <path
                                                        d="M15,10c0-0.55,0.45-1,1-1s1,0.45,1,1c0,0.55-0.45,1-1,1S15,10.55,15,10z M8,9h5V7H8V9z M22,7.5v6.97l-2.82,0.94L17.5,21 L12,21v-2h-2v2l-5.5,0C4.5,21,2,12.54,2,9.5S4.46,4,7.5,4l5,0c0.91-1.21,2.36-2,4-2C17.33,2,18,2.67,18,3.5 c0,0.21-0.04,0.4-0.12,0.58c-0.14,0.34-0.26,0.73-0.32,1.15l2.27,2.27H22z M20,9.5h-1L15.5,6c0-0.65,0.09-1.29,0.26-1.91 C14.79,4.34,14,5.06,13.67,6L7.5,6C5.57,6,4,7.57,4,9.5c0,1.88,1.22,6.65,2.01,9.5L8,19v-2h6v2l2.01,0l1.55-5.15L20,13.03V9.5z"/>
                                                </g>
                                            </svg>
                                            <p class="ml-3">Vendor has no reviews yet!</p>
                                        </div>
                                    @else
                                        <div class="flex flex-shrink-0 justify-between">Quality:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $product->user->vendor -> roundAvgRate('quality_rate')])
                                                ({{ $product->user -> vendor -> avgRate('quality_rate') }})
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('positive')}}--}}
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('neutral')}}--}}
                                                {{--                                            {{$product->user->vendor->countFeedbackByType('negative')}}--}}
                                            </p>
                                        </div>
                                        <div class="flex flex-shrink-0 justify-between">Communication:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $product->user->vendor -> roundAvgRate('communication_rate')])
                                                ({{ $product->user -> vendor -> avgRate('communication_rate') }})</p>
                                        </div>
                                        <div class="flex flex-shrink-0 justify-between">Shipping:
                                            <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => $product->user->vendor -> roundAvgRate('shipping_rate')])
                                                ({{ $product->user -> vendor -> avgRate('shipping_rate') }})</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="text-lg font-bold">
                                Stocks
                            </legend>

                            <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                                <div class="grid grid-cols-11 text-center">
                                    <p class="col-span-5">
                                        <button class="bg-green-500 text-white rounded-md p-0.5 block mx-auto">
                                            LEFT
                                        </button>
                                        {{$product->quantity . ' ' . $product->count_type}}</p>
                                    <div class="divider lg:divider-horizontal"></div>
                                    <p class="col-span-5">
                                        {{ $product -> getOrdersAmount() }} {{$product->count_type}}

                                        <button class="block mx-auto bg-blue-500 text-white rounded-md p-0.5">
                                            SOLD
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </fieldset>

                        @if($product->isPhysical())
                            <fieldset>
                                <legend class="text-lg font-bold">
                                    Delivery Area
                                </legend>

                                <div class="p-4 bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                                    <div class="grid grid-cols-11 text-center">
                                        <p class="col-span-5">

                                            {{$product->physical->country_from}}</p>
                                        <p>TO</p>
                                        <p class="col-span-5">
                                            {{$product->physical->countries}}

                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        @endif

                        <fieldset>
                            <legend class="text-lg font-bold">
                                @if($product->isPhysical())
                                    Offers & Shippings
                                @else
                                    Offer
                                @endif
                            </legend>

                            @if($product->count_type === "milliliter")
                                @php
                                    $product->count_type = "ml"
                                @endphp
                            @endif

                            <div class="bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4">
                                <table class="table table-zebra  overflow-x-auto w-full">
                                    <!-- head -->
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-lg">Min Order</th>
                                        <th class="text-lg">Price per {{$product->count_type}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- row -->
                                    @foreach($product->offers as $offer)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$offer->min_quantity . ' ' . $product->count_type}}</td>
                                            @if (auth()->user())
                                                @if (auth()->user()->currency == 'usd')
                                                    <td>{{'$' . $offer->price . ' ' . 'per' . ' ' . $product->count_type}}</td>
                                                @endif @if(auth()->user()->currency == 'euro')
                                                    <td>{{'€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($offer->price),2) . ' ' . 'per' . ' ' . $product->count_type}}</td>
                                                @endif @if(auth()->user()->currency == 'gbp')
                                                    <td>{{'£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($offer->price),2) . ' ' . 'per' . ' ' . $product->count_type}}</td>
                                                @endif @if(auth()->user()->currency == 'try')
                                                    <td>{{'₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($offer->price),2) . ' ' . 'per' . ' ' . $product->count_type}}</td>
                                                @endif
                                            @else
                                                <td>{{'$' . $offer->price . ' ' . 'per' . ' ' . $product->count_type}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>

                        @if($product->isPhysical())
                            <div class="bg-gray-100 dark:bg-slate-800 border rounded mt-4 space-y-4 overflow-x-auto">
                                <table class="table table-zebra overflow-x-auto w-full">
                                    <!-- head -->
                                    <thead class="">
                                    <tr>
                                        <th></th>
                                        <th class="text-lg">Name</th>
                                        <th class="text-lg">Price</th>
                                        <th class="text-lg">Duration</th>
                                        <th class="text-lg">Order Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- row -->
                                    @foreach($product->physical->shippings as $shipping)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$shipping->name}}</td>
                                            @if (auth()->user())
                                                @if (auth()->user()->currency == 'usd')
                                                    <td>${{$shipping->price}}</td>
                                                @endif @if(auth()->user()->currency == 'euro')
                                                    <td>{{'€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($shipping->price),2)}}</td>
                                                @endif @if(auth()->user()->currency == 'gbp')
                                                    <td>{{'£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($shipping->price),2)}}</td>
                                                @endif @if(auth()->user()->currency == 'try')
                                                    <td>{{'₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($shipping->price),2)}}</td>
                                                @endif
                                            @else
                                                <td>${{$shipping->price}}</td>
                                            @endif
                                            <td>{{$shipping->duration}}</td>
                                            <td>{{$shipping->from_quantity}}
                                                - {{$shipping->to_quantity}} {{$product->count_type}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        @auth
                            <fieldset>
                                <legend class="text-lg font-bold">
                                    Wish / Order
                                </legend>
                            </fieldset>
                            <div class="w-full flex">
                                @if(auth() -> user() -> isWhishing($product))
                                    <a href="{{ route('profile.wishlist.add', $product) }}"
                                       class="min-w-full text-center px-6 py-3 text-sm font-bold tracking-wider uppercase bg-gray-100  rounded-sm bg-pink-900 text-white"
                                    >
                                        Remove from wishlist

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="inline-block h-5 w-5 ml-2 text-white align-text-bottom "
                                             height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                                            <g>
                                                <rect fill="none" height="24" width="24"/>
                                            </g>
                                            <g>
                                                <path
                                                    d="M16.5,3c-0.96,0-1.9,0.25-2.73,0.69L12,9h3l-3,10l1-9h-3l1.54-5.39C10.47,3.61,9.01,3,7.5,3C4.42,3,2,5.42,2,8.5 c0,4.13,4.16,7.18,10,12.5c5.47-4.94,10-8.26,10-12.5C22,5.42,19.58,3,16.5,3z M10.24,16.73C6.45,13.34,4,11,4,8.5 C4,6.54,5.54,5,7.5,5c0.59,0,1.19,0.15,1.73,0.42L7.35,12h3.42L10.24,16.73z M15.13,15.53L17.69,7h-2.91l0.61-1.82 C15.75,5.06,16.13,5,16.5,5C18.46,5,20,6.54,20,8.5C20,10.71,17.98,12.93,15.13,15.53z"/>
                                            </g>
                                        </svg>
                                    </a>

                                @else

                                    <a href="{{ route('profile.wishlist.add', $product) }}"
                                       class="min-w-full text-center  px-6 py-3 text-sm font-bold tracking-wider  uppercase bg-gray-100 rounded-sm bg-pink-900 text-white"
                                    >
                                        Add to wish list

                                        <svg class="inline-block h-5 w-5 ml-2 text-white align-text-bottom " width="24"
                                             height="24"
                                             viewBox="0 0 24 24"
                                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"/>
                                            <path
                                                d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endauth


                        <form action="{{ route('profile.cart.add', $product) }}" method="POST">
                            @csrf
                            @if($product->isPhysical())
                                <div class="rounded-sm">
                                    <div class="">
                                        <label for="shipping" class="hidden">Select Shipping</label>
                                        <select id="shipping"
                                                name="shipping" id="shipping"
                                                class="text-center h-10 rounded-t-sm  text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option disabled selected hidden>CHOOSE SHIPPING METHOD</option>
                                            @foreach($product -> specificProduct() -> shippings as $shipping)
                                                @if (auth()->user())
                                                    @if (auth()->user()->currency == 'usd')
                                                        <option
                                                            value="{{$shipping->name}}">{{$shipping->name . ' ' . '$' . $shipping->price }}</option>
                                                    @endif @if(auth()->user()->currency == 'euro')
                                                        <option
                                                            value="{{$shipping->name}}">{{$shipping->name . ' ' . '€' . round(\App\Marketplace\Utility\FiatConverter::usd2Eur($shipping->price),2)}}</option>
                                                    @endif @if(auth()->user()->currency == 'gbp')
                                                        <option
                                                            value="{{$shipping->name}}">{{$shipping->name . ' ' . '£' . round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($shipping->price),2)}}</option>
                                                    @endif @if(auth()->user()->currency == 'try')
                                                        <option
                                                            value="{{$shipping->name}}">{{$shipping->name . ' ' . '₺' . round(\App\Marketplace\Utility\FiatConverter::usd2Try($shipping->price),2)}}</option>
                                                    @endif
                                                @else
                                                    <option
                                                        value="{{$shipping->name}}">{{$shipping->name . ' ' . '$' . $shipping->price }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div
                                        class="mx-auto w-full justify-center flex items-center bg-blue-900">
                                        <div class="px-6">
                                            <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24"
                                                 stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"/>
                                                <line x1="12" y1="3" x2="12" y2="21"/>
                                                <line x1="9" y1="21" x2="15" y2="21"/>
                                                <polyline points="3 6 6 7 12 5 18 7 21 6"/>
                                                <path d="M6 7l-3 9a5 5 0 0 0 6 0l-3 -9"/>
                                                <path d="M18 7l-3 9a5 5 0 0 0 6 0l-3 -9"/>
                                            </svg>
                                        </div>

                                        <div class="w-full">
                                            <input type="number" min="0" step="1"
                                                   autocomplete="off"
                                                   name="amount" id="amount"
                                                   class="text-center w-full h-12 px-4 py-1 dark:text-white bg-sky-800 focus:outline-none no-spinners"
                                                   placeholder="0">
                                        </div>

                                        <div>
                                            <p class="px-4 uppercase">{{$product->count_type}}</p>
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        class="w-full px-6 py-3 text-sm font-bold tracking-wide text-white uppercase bg-blue-900 rounded-b-sm"
                                    >
                                        Add to cart

                                        <svg class="h-4 w-4 ml-2 text-white inline-block" viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <circle cx="9" cy="21" r="1"/>
                                            <circle cx="20" cy="21" r="1"/>
                                            <path
                                                d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                        </svg>

                                    </button>
                                </div>
                            @else
                                <button
                                    type="submit"
                                    class="w-full px-6 py-3 text-sm font-bold tracking-wide text-white uppercase bg-blue-800 rounded-b-sm"
                                >
                                    Add to cart

                                    <svg class="h-4 w-4 ml-2 text-white inline-block" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"/>
                                        <circle cx="20" cy="21" r="1"/>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                    </svg>

                                </button>
                            @endif
                        </form>
                    </div>
                </div>

            </div>


        </div>

    </x-slot>
</x-layout>
