<x-layout>
    <x-slot name="content">
        <x-vendorCP.tabmenu/>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center  justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>

                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Listed
                                Items</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You
                                have {{count(auth()->user()->products)}} listed items for
                                sale.</p>
                        </div>
                    </div>
                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <polyline points="3 17 9 11 13 15 21 7"/>
                                    <polyline points="14 7 21 7 21 14"/>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Sales</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You have
                                sold {{count(auth()->user()->sales)}} products so
                                far.</p>
                        </div>
                    </div>
                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="12" cy="9" r="6"/>
                                    <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(-30 12 9)"/>
                                    <polyline points="9 14.2 9 21 12 19 15 21 15 14.2" transform="rotate(30 12 9)"/>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">
                                Reviews</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You got
                                total {{auth()->user()->vendor->countFeedback()}} reviews.
                            @if(!auth()->user()->vendor->countFeedback() < 1)
                                <div class="border p-2 mt-2 rounded-sm">
                                    <p class="dark:text-red-300">Your Average</p>
                                    <div class="flex flex-shrink-0 justify-between dark:text-violet-300">Quality:
                                        <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => auth()->user()->vendor -> roundAvgRate('quality_rate')])
                                            ({{ auth()->user()-> vendor -> avgRate('quality_rate') }})
                                            {{--                                            {{$product->user->vendor->countFeedbackByType('positive')}}--}}
                                            {{--                                            {{$product->user->vendor->countFeedbackByType('neutral')}}--}}
                                            {{--                                            {{$product->user->vendor->countFeedbackByType('negative')}}--}}
                                        </p>
                                    </div>
                                    <div class="flex flex-shrink-0 justify-between dark:text-violet-300">Communication:
                                        <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => auth()->user()->vendor -> roundAvgRate('communication_rate')])
                                            ({{ auth()->user()-> vendor -> avgRate('communication_rate') }})</p>
                                    </div>
                                    <div class="flex flex-shrink-0 justify-between dark:text-violet-300">Shipping:
                                        <p class="flex flex-shrink-0">@include('components.svg.feedback-stars', ['stars' => auth()->user()->vendor -> roundAvgRate('shipping_rate')])
                                            ({{ auth()->user()-> vendor -> avgRate('shipping_rate') }})</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="xl:w-1/2 md:w-1/1 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <line x1="3" y1="21" x2="21" y2="21"/>
                                    <path
                                        d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"/>
                                    <path d="M5 21v-10.15"/>
                                    <path d="M19 21v-10.15"/>
                                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"/>
                                </svg>
                            </div>
                            <a href="/vendor/{{auth()->user()->username}}"
                               class="bg-indigo-500 dark:bg-fuchsia-900 text-white rounded-md p-1 float-right text-md">Go
                                My Marketplace</a>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Market
                                Profile</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">
                                See your market profile through the eyes of users.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-layout>
