<nav>
    <header class="shadow-sm shadow-blue-100">
        <div class="flex items-center justify-between h-32 max-w-screen-xl px-4 mx-auto">
            <div class="flex flex-1 items-center space-x-4">
                <div class="w-40 h-20 bg-gray-200 rounded-lg">
                    <a href="/"><img src="/img/logo.jpg" alt=""></a>
                </div>
            </div>


            {{--            guest mobile--}}
            @guest()
                <div class="flex justify-end flex-1 w-0 lg:hidden gap-3 ">
                    <a class="p-2 text-gray-500 bg-gray-100 rounded-full" href="{{route('auth.signup')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                             fill="#000000">
                            <g>
                                <rect fill="none" height="24" width="24"/>
                                <rect fill="none" height="24" width="24"/>
                            </g>
                            <g>
                                <g>
                                    <polygon
                                        points="22,9 22,7 20,7 20,9 18,9 18,11 20,11 20,13 22,13 22,11 24,11 24,9"/>
                                    <path
                                        d="M8,12c2.21,0,4-1.79,4-4s-1.79-4-4-4S4,5.79,4,8S5.79,12,8,12z M8,6c1.1,0,2,0.9,2,2s-0.9,2-2,2S6,9.1,6,8S6.9,6,8,6z"/>
                                    <path
                                        d="M8,13c-2.67,0-8,1.34-8,4v3h16v-3C16,14.34,10.67,13,8,13z M14,18H2v-0.99C2.2,16.29,5.3,15,8,15s5.8,1.29,6,2V18z"/>
                                    <path
                                        d="M12.51,4.05C13.43,5.11,14,6.49,14,8s-0.57,2.89-1.49,3.95C14.47,11.7,16,10.04,16,8S14.47,4.3,12.51,4.05z"/>
                                    <path
                                        d="M16.53,13.83C17.42,14.66,18,15.7,18,17v3h2v-3C20,15.55,18.41,14.49,16.53,13.83z"/>
                                </g>
                            </g>
                        </svg>
                    </a>
                    <a class="p-2 text-gray-600 bg-gray-100 rounded-full" href="{{route('auth.signin')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                             fill="#000000">
                            <g>
                                <rect fill="none" height="24" width="24"/>
                            </g>
                            <g>
                                <path
                                    d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z"/>
                            </g>
                        </svg>
                    </a>
                </div>
            @endguest
            {{--            auth mobile--}}
            @auth()
                <div class="flex flex-1 w-0 lg:hidden justify-end ">
                    <form action="{{route('auth.signout.post')}}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 text-gray-600 bg-gray-100 rounded-full">
                            <svg class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>

                        </button>
                    </form>
                </div>


            @endauth
            {{--            endOf auth mobile--}}
            {{--            mobile theme switch--}}
            <div class="flex flex-1 w-0 lg:hidden justify-center">

                <form action="{{route('theme.switch.post')}}" method="POST">
                    @csrf
                    @if(!request()->session()->exists('white'))
                        <button id="theme-toggle" type="submit"
                                class="border border-black dark:text-gray-100 bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none focus:ring-4 dark:focus:ring-gray-700 rounded-full text-sm p-2.5">
                            <svg id="theme-toggle-light-icon" class=" w-5 h-5" fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    @else
                        <button id="theme-toggle" type="submit"
                                class="border border-black text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-full text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class=" w-5 h-5 " fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>
                    @endif

                </form>

            </div>
            {{--            endof mobile theme switch--}}

            <div class="items-center hidden space-x-4 lg:flex">
                {{--                dark:bg-sky-900 dark:text-white--}}
                @guest()
                    <a class="px-5 py-2 text-sm font-medium rounded-lg text-gray-600 bg-gray-200 @if(request()->routeIs('auth.signin')) bg-gray-600 text-gray-200 dark:bg-sky-900 dark:text-white @endif"
                       href="{{route('auth.signin')}}"> Sign in </a>
                    <a class="px-5 py-2 text-sm font-medium rounded-lg text-gray-600 bg-gray-200 @if(request()->routeIs('auth.signup')) bg-gray-600 text-gray-200 dark:bg-sky-900 dark:text-white @endif"
                       href="{{route('auth.signup')}}"> Sign up </a>
                @endguest
                @auth()
                    <a class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100  dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('profile*') && !request()->is('profile/vendor*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif"
                       href="{{route('profile.index')}}"> UserCP </a>
                    @vendor
                    <a class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('profile/vendor*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif"
                       href="{{route('profile.vendor')}}"> VendorCP </a>
                    @endvendor
                    @admin
                    <a class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('admin*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif"
                       href="{{route('admin.index')}}"> AdminCP </a>
                    @endadmin
                    <div class="divider lg:divider-horizontal"></div>


                    <div class="flex flex-1 justify-center gap-2">
                        <form action="{{route('auth.signout.post')}}" method="POST"
                              class="
                              border border-black dark:border-gray-300 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            @csrf
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                     viewBox="0 0 24 24" width="24px" fill="currentColor">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none"/>
                                    </g>
                                    <g>
                                        <path
                                            d="M19,19V5c0-1.1-0.9-2-2-2H7C5.9,3,5,3.9,5,5v14H3v2h18v-2H19z M17,19H7V5h10V19z M13,11h2v2h-2V11z"/>
                                    </g>
                                </svg>
                            </button>
                        </form>

                        <a id="notifications" href="{{route('profile.notifications')}}"
                           @if(auth()->user()->unreadNotifications()->count() > 0)
                           class="border border-black dark:border-red-900 text-gray-500 dark:text-red-600
                           hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4
                           focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 flex">

                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                 fill="currentColor" class="animate-swing ">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path
                                    d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/>
                            </svg>

                            @else
                                class="border border-black dark:border-gray-300 text-gray-500 dark:text-gray-400
                                hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4
                                focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                     fill="currentColor" class="">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path
                                        d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/>
                                </svg>

                            @endif


                        </a>

                        <a id="messages" href="{{route('profile.messages')}}"
                           @if(auth()->user()->getUnReadCount() > 0)
                           class="border border-black dark:border-red-900 text-gray-500 dark:text-red-600
                           hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4
                           focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 flex">

                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                 fill="currentColor" class="animate-bounce ">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path
                                    d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/>
                            </svg>
                            @else
                                class="border border-black dark:border-gray-300 text-gray-500 dark:text-gray-400
                                hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4
                                focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                     fill="currentColor">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path
                                        d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/>
                                </svg>
                            @endif
                        </a>
                    </div>

                    <button class="px-5 py-2 text-sm font-medium text-white bg-blue-600 dark:bg-indigo-700 rounded-lg">
                        Welcome {{request()->user()->username}}</button>
                @endauth
                <div class="divider lg:divider-horizontal"></div>
                <div class="">
                    <form action="{{route('theme.switch.post')}}" method="POST">
                        @csrf
                        @if(request()->session()->exists('white'))
                            <button id="theme-toggle" type="submit"
                                    class="border border-black text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-full text-sm p-2.5">
                                <svg id="theme-toggle-dark-icon" class=" w-6 h-6" fill="currentColor"
                                     viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </button>
                        @else
                            <button id="theme-toggle" type="submit"
                                    class="border border-black dark:text-gray-100 bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none focus:ring-4 dark:focus:ring-gray-700 rounded-full text-sm p-2.5">
                                <svg id="theme-toggle-light-icon" class="w-6 h-6" fill="white"
                                     viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        @endif

                    </form>
                </div>
            </div>


        </div>

        {{--          mobil  control menu--}}
        @auth()
            <div class="flex max-w-screen-xl px-4 py-2 border-t border-gray-100 lg:hidden">
                <a class="flex flex-1 justify-center" href="{{route('profile.index')}}">
                    <div
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100  dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('profile*') && !request()->is('profile/vendor*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif">
                        <p class="text-center">UserCP</p>
                    </div>
                </a>
                @vendor
                <a class="flex flex-1 justify-center" href="{{route('profile.vendor')}}">
                    <div
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('profile/vendor*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif">
                        <p>VendorCP</p>
                    </div>
                </a>
                @endvendor
                @admin
                <a class="flex flex-1 justify-center" href="{{route('admin.index')}}">
                    <div
                        class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-700 rounded-lg @if(request()->is('admin*')) text-gray-600 bg-gray-100 dark:bg-yellow-900 dark:text-gray-300 @endif">
                        <p>AdminCP</p>
                    </div>
                </a>
                @endadmin
                <div class="flex flex-1 justify-center gap-1">
                    <div class="bg-gray-200 rounded-lg p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                             fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path
                                d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/>
                        </svg>
                    </div>
                    <div class="bg-gray-200 rounded-lg p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                             fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path
                                d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/>
                        </svg>
                    </div>
                </div>
            </div>
        @endauth

    </header>

</nav>
