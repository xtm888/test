<div class="border-b border-gray-200 dark:border-gray-200 p-2 flex flex-col items-center mb-10">
    <ul class="flex flex-wrap -mb-px justify-center space-x-4">

        <li class="mr-2">
            <a href="{{route('profile.index')}}"
               class="{{request()->routeIs('profile.index') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.index') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                </svg>

                Account
            </a>
            <a href="{{route('profile.settings')}}"
               class="{{request()->routeIs('profile.settings') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.settings') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>

                Settings
            </a>
        <li class="mr-2">
            <a href="{{route('profile.wallet')}}"
               class="{{request()->routeIs('profile.wallet') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.wallet') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />

                </svg>

                Deposit/Withdraw
            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.wishlist')}}"
               class="{{request()->routeIs('profile.wishlist') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.wishlist') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>

                Wishlist
            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.cart')}}"
               class="{{request()->routeIs('profile.cart') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.cart') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>

                Cart
            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.purchases')}}"
               class="{{request()->routeIs('profile.purchases') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.purchases') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />

                </svg>
                Purchases

            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.messages')}}"
               class="{{request()->routeIs('profile.messages') || request()->routeIs('user.readconversation') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.messages') || request()->routeIs('user.readconversation') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />

                </svg>
                Messages

            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.notifications')}}"
               class="{{request()->routeIs('profile.notifications') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.notifications') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                Notifications

            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.invites')}}"
               class="{{request()->routeIs('profile.invites') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.invites') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
                Invites

            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('profile.tickets')}}"
               class="{{request()->routeIs('profile.tickets') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.tickets') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd" />
                </svg>
                Support

            </a>
        </li>
    </ul>
</div>
