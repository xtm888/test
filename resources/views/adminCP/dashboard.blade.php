<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900 p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center  justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>

                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Users</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">Marketplace have {{App\Models\User::count()}} Registered Users.</p>
                        </div>
                    </div>
                    <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900  p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="1" x2="12" y2="23" />  <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" /></svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Sales</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">{{App\Models\Purchase::count()}} sales has been made via Marketplace.</p>
                        </div>
                    </div>

                    <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900  p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>

                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Listing</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">{{App\Models\Product::count()}} Items listing on the market.</p>
                        </div>
                    </div>
                    <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900  p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="9" cy="7" r="4" />  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />  <path d="M16 11h6m-3 -3v6" /></svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">New Users</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">{{App\Models\User::where('created_at', '>=', \Carbon\Carbon::today()->toDateString())->count()}} Users has been registered today.</p>
                        </div>
                    </div>
                    <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                        <div class="border border-gray-200 dark:bg-indigo-900  p-6 rounded-lg">
                            <div
                                class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-blue-100 text-blue-500 mb-4">
                                <svg class="h-8 w-8"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="2" y1="12" x2="22" y2="12" />  <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" /></svg>
                            </div>
                            <h2 class="text-lg text-gray-900 dark:text-rose-400 font-medium title-font mb-2">Online (Not Active)</h2>
                            <p class="leading-relaxed text-base dark:text-gray-300">x Users online now.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>
</x-layout>
