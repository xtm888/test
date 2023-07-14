<x-layout>

    <x-slot name="title">
        User Control Panel
    </x-slot>

    <x-slot name="content">
        <x-userCP.tabmenu/>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">

                <div class="mx-auto w-3/12 h-72 -mt-24">
                    <x-svg.usercp-account-cat/>
                </div>

                <div class="flex flex-wrap -m-4 -mt-8">
                    <div class="md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center  justify-center rounded-full bg-blue-100  text-blue-500 mb-4">

                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>

                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Orders</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You bought {{count($purchases)}}
                                {{Str::plural('item', count($purchases))}} from the market</p>
                        </div>
                    </div>

                    <div class="md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <rect x="3" y="5" width="18" height="14" rx="3"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                    <line x1="7" y1="15" x2="7.01" y2="15"/>
                                    <line x1="11" y1="15" x2="13" y2="15"/>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">
                                Balance</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You have {{round( ($readyBalance),3)}} XMR balance in your
                                account.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <circle cx="6" cy="6" r="2"/>
                                    <circle cx="18" cy="18" r="2"/>
                                    <path d="M11 6h5a2 2 0 0 1 2 2v8"/>
                                    <polyline points="14 9 11 6 14 3"/>
                                    <path d="M13 18h-5a2 2 0 0 1 -2 -2v-8"/>
                                    <polyline points="10 15 13 18 10 21"/>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Earn
                                together</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You invited {{$countInvites}} people to market.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8" width="24" height="24" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path
                                        d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/>
                                </svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">
                                Security</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">You did not enable 2FA. Please
                                enable it for account
                                security.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </x-slot>
</x-layout>
