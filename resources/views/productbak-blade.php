<x-layout>
    <x-slot name="content">
        <section>
            <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
                <div>
                    <h1 class="text-2xl font-bold lg:text-3xl">
                        {{$product->name}}
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Item List Number: #{{$product->list_id}}
                    </p>
                </div>

                <div class="grid gap-8 lg:items-start lg:grid-cols-4">
                    <div class="lg:col-span-3">
                        <div class="relative mt-4">
                            <img
                                alt=""
                                src="/storage/{{$mainImage->image}}"
                                class="w-full rounded-xl h-72 lg:h-[540px] object-cover"
                            />

                            <div
                                class="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-black/75 text-white px-3 py-1.5 inline-flex items-center">
                                <svg
                                    class="w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>

                                <span class="text-xs ml-1.5">
              Hover to zoom
            </span>
                            </div>
                        </div>
                        <ul class="flex gap-1 mt-1">
                            @foreach($product->images->where('first',0)->all() as $image)
                            <li>
                                <a href="/storage/{{$image->image}}"><img class="object-cover w-16 h-16 rounded-md"
                                                                          src="/storage/{{$image->image}}"
                                                                          alt=""/>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="lg:top-0 lg:sticky">
                        <div class="space-y-4 lg:pt-8">
                            <fieldset>
                                <legend class="text-lg font-bold">
                                    Seller
                                </legend>

                                <div class="p-4 bg-gray-100 border rounded mt-4">
                                    <a href="/vendor/{{$product->user->username}}" class="">
                                        <p class="block">
                                            {{$product->user->username}} <span
                                                class="text-xs text-red-600">(4 rev)</span></p></a>
                                    <div class="flex mt-2 -ml-0.5">
                                        <svg
                                            class="w-5 h-5 text-yellow-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>

                                        <svg
                                            class="w-5 h-5 text-yellow-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>

                                        <svg
                                            class="w-5 h-5 text-yellow-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>

                                        <svg
                                            class="w-5 h-5 text-yellow-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>

                                        <svg
                                            class="w-5 h-5 text-gray-200"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        >
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="text-lg font-bold">
                                    Stocks
                                </legend>

                                <div class="p-4 bg-gray-100 border rounded mt-4 space-y-4">
                                    <div class="grid grid-cols-11 text-center">
                                        <p class="col-span-5">
                                            <button class="bg-green-500 text-white rounded-md p-0.5 lg:block mx-auto">
                                                LEFT
                                            </button>
                                            {{$product->amount_wcount}}</p>
                                        <p class="col-span-1">|</p>
                                        <p class="col-span-5">
                                            {{$product->amount_wcount}}
                                            <button class="bg-blue-500 text-white rounded-md p-0.5">
                                                SOLD
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend class="text-lg font-bold">
                                    Offers
                                </legend>

                                <div class="p-4 bg-gray-100 border rounded mt-4 space-y-4">
                                    @foreach($product->offers as $offer)
                                    <div class="border flex flex-col leading-3">
                                        <p class="text-center p-2">
                                            Min order: {{$offer->min_quantity . ' ' . $product->count_type}}

                                            <svg class="h-8 w-8 text-black mx-auto" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"/>
                                                <path d="M18 15l-6-6l-6 6h12" transform="rotate(180 12 12)"/>
                                            </svg>

                                            {{'$' . $offer->price . ' ' . 'per' . ' ' . $product->count_type}}
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            </fieldset>


                            @auth
                            @if(auth() -> user() -> isWhishing($product))
                            <a href="{{ route('profile.wishlist.add', $product) }}"
                               class="w-full px-6 py-3 text-sm font-bold tracking-wide uppercase bg-gray-100 border border-gray-300 rounded bg-pink-600 text-white"
                            >
                                Remove from wishlist

                                <svg class="inline-block h-5 w-5 ml-2 text-white" width="24" height="24"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"/>
                                </svg>
                            </a>

                            @else
                            <a href="{{ route('profile.wishlist.add', $product) }}"
                               class="w-full px-6 py-3 text-sm font-bold tracking-wide uppercase bg-gray-100 border border-gray-300 rounded bg-pink-600 text-white"
                            >
                                Add to wish list

                                <svg class="inline-block h-5 w-5 ml-2 text-white" width="24" height="24"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"/>
                                </svg>
                            </a>
                            @endif
                            @endauth


                            <form action="{{ route('profile.cart.add', $product) }}" method="POST">
                                @csrf
                                @if($product->isPhysical())
                                <div class="bg-white border rounded-md">
                                    <div class="">
                                        <label for="shipping" class="hidden">Select Shipping</label>
                                        <select id="shipping"
                                                name="shipping" id="shipping"
                                                class="text-center h-10 rounded-t-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option disabled selected hidden>CHOOSE SHIPPING METHOD</option>
                                            @foreach($product -> specificProduct() -> shippings as $shipping)
                                            <option
                                                value="{{$shipping->name}}">{{$shipping->name . ' ' . '$' . $shipping->price }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div
                                        class=" border mx-auto  w-full justify-center flex items-center">
                                        <div>
                                            <p class="px-4">AMOUNT</p>
                                        </div>

                                        <div class="w-full">
                                            <input type="number" min="0" step="1"
                                                   name="amount" id="amount"
                                                   class="text-center w-full h-12 px-4 py-1 border border-gray-100 text-gray-800 focus:outline-none"
                                                   placeholder="0">
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        class="w-full px-6 py-3 text-sm font-bold tracking-wide text-white uppercase bg-blue-600 rounded-b-sm"
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
                                    class="w-full px-6 py-3 text-sm font-bold tracking-wide text-white uppercase bg-blue-600 rounded-b-sm"
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

                    <div class="lg:col-span-3 -mt-0 lg:-mt-16">
                        <div class="max-w-none border-t border-dashed border-gray-300 pt-6">
                            <p class="text-lg">
                                {{$product->description}}
                            </p>
                        </div>
                        @if($product->video)
                        @php
                        $videoExtension = explode(".", $product->video->video)
                        @endphp
                        <div class="mt-4 mx-auto border-t border-dashed border-gray-300 pt-6">
                            <video width="920" height="740" controls>
                                <source src="/storage/{{$product->video->video}}"
                                        type="video/{{$videoExtension[1]}}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-layout>
