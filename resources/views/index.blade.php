<x-layout>
    <x-slot name="content">
        <section>

            <div class="max-w-screen-2xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:items-start"
                >

                    <div class="hidden lg:block lg:sticky lg:top-4">
                        @include('components/_categories')
                    </div>


                    <div class="lg:col-span-3">

                        <section>

                            <div class="px-8 py-12">
                                <div class="grid gap-8 items-start justify-center">
                                    <div class="relative group">
                                        <div
                                            class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-purple-600 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                                        <button
                                            class="relative px-7 py-4 bg-white dark:bg-gray-900 rounded-lg leading-none flex items-center ">
        <span class="flex items-center space-x-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600 -rotate-12" viewBox="0 0 18 18"
                 fill="none" stroke="currentColor"><g></g><g><path
                        d="M16,3H4L2,8l8,9l8-9L16,3z M8.21,7.25L9.59,4.5h0.82l1.38,2.75H8.21z M9.25,8.75v5.15L4.67,8.75H9.25z M10.75,8.75h4.58 l-4.58,5.15V8.75z M16.08,7.25h-2.62L12.09,4.5h2.9L16.08,7.25z M5.02,4.5h2.9L6.54,7.25H3.92L5.02,4.5z"/></g></svg>

          <span class="dark:text-gray-100 text-black text-lg">Welcome To The</span>
        </span>
                                            <span
                                                class="pl-6 text-indigo-400 group-hover:text-gray-100 transition duration-200 text-xl">{{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-screen-xl px-4 pb-16 mx-auto sm:px-6 lg:px-8">
                                <dl class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                                    @foreach(array_filter(json_decode(Cache::tags(['MarketPlace'])->get('MPCACHE')->articles,true), function ($item) {return $item["published"] == true;}) as $article)
                                        <div>
                                            <dt class="text-xl font-medium">
                                                {{$article['title']}}
                                            </dt>

                                            <dd class="pt-4 mt-4 border-t border-gray-200">
                                                {{$article['description']}}
                                            </dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                        </section>


                        {{--                        <div class="flex items-center justify-end">--}}
                        {{--                            <div class="ml-4">--}}
                        {{--                                <label--}}
                        {{--                                    for="SortBy"--}}
                        {{--                                    class="sr-only"--}}
                        {{--                                >--}}
                        {{--                                    Sort--}}
                        {{--                                </label>--}}

                        {{--                                <select--}}
                        {{--                                    id="SortBy"--}}
                        {{--                                    name="sort_by"--}}
                        {{--                                    class="text-sm border-gray-100 rounded"--}}
                        {{--                                >--}}
                        {{--                                    <option readonly>Sort</option>--}}
                        {{--                                    <option value="title-asc">Title, A-Z</option>--}}
                        {{--                                    <option value="title-desc">Title, Z-A</option>--}}
                        {{--                                    <option value="price-asc">Price, Low-High</option>--}}
                        {{--                                    <option value="price-desc">Price, High-Low</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        @if(count($products))
                            <div
                                class=" grid grid-cols-1 gap-px mt-4 sm:grid-cols-2 lg:grid-cols-3 bg-gray-200 border-2 border-gray-200">
                                @foreach($products as $product)
                                    <div class="border-gray-200 relative block bg-white dark:bg-slate-900">

                                        <a href="{{ route('profile.wishlist.add', $product) }}">
                                            @if(auth()->check() && auth() -> user() -> isWhishing($product))
                                                <button
                                                    type="button"
                                                    name="wishlist"
                                                    class="absolute p-2 text-white bg-black rounded-full right-4 top-4"
                                                >

                                                    <svg class="w-4 h-4 animate-pulse  " fill="orange" stroke="yellow"
                                                         viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                </button>
                                            @else
                                                <button
                                                    type="button"
                                                    name="wishlist"
                                                    class="absolute p-2 text-white bg-black rounded-full right-4 top-4"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                </button>
                                            @endif

                                        </a>

                                        <a
                                            href="{{route('product.show',$product->id)}}"
                                            class=""
                                        >
                                            <img
                                                loading="lazy"
                                                alt="{{$product->name}}"
                                                class="object-fill w-full h-56 lg:h-72"
                                                src="/storage/{{$product->frontImageOnIndex()}}"
                                            />

                                            <div class="p-6 ">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-medium bg-yellow-400 dark:bg-yellow-500 dark:text-slate-600">
                                        {{$product->category->name}}
                                        </span>

                                                <h5 class="mt-4 text-lg font-bold h-12"
                                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                    {{$product->name}}
                                                </h5>

                                                <div class="py-4">
                                                    <p class="mt-2 font-medium text-gray-800 dark:text-gray-400">
                                                        Best Offer @if (auth()->user()) @if (auth()->user()->currency == 'usd')${{$product->offers->first()->price}}@endif @if(auth()->user()->currency == 'euro') €{{round(\App\Marketplace\Utility\FiatConverter::usd2Eur($product->offers->first()->price),2)}}@endif @if(auth()->user()->currency == 'gbp') £{{round(\App\Marketplace\Utility\FiatConverter::usd2Gbp($product->offers->first()->price),2)}}@endif @if(auth()->user()->currency == 'try') ₺{{round(\App\Marketplace\Utility\FiatConverter::usd2Try($product->offers->first()->price),2)}}@endif @else ${{$product->offers->first()->price}} @endif
                                                        per {{$product->count_type}}
                                                    </p>
                                                    <p class="mt-2 font-medium text-gray-600 dark:text-gray-200">
                                                        with minimum
                                                        order {{$product->offers->first()->min_quantity . " " . $product->count_type}}
                                                    </p>
                                                </div>

                                                <button
                                                    name="add"
                                                    type="button"
                                                    class="flex items-center justify-center w-full px-8 py-4 mt-4 bg-yellow-500 rounded-sm dark:bg-yellow-600 dark:text-slate-700"
                                                >
                                        <span class="text-sm font-medium">
                                        Add to Cart
                                        </span>

                                                    <svg class="w-5 h-5 ml-1.5" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{ $products->links() }}
                        @else
                            <div class="w-fit mx-auto">
                                <p class="uppercase text-xl font-bold border-2 border-black p-4 shadow-xl dark:border-indigo-900 dark:shadow-indigo-900">
                                    No Product Has Been Found!
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

            </div>

            <div class="block lg:hidden mx-4">
                @include('components/_categories')
            </div>
        </section>
    </x-slot>
</x-layout>
