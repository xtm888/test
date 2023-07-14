<div class="border-b border-gray-200 dark:border-gray-200 p-2 flex flex-col items-center mb-10">
    <ul class="flex flex-wrap -mb-px justify-center space-x-4">
        <li class="mr-2">
            <a href="{{route('admin.index')}}"
               class="{{request()->routeIs('admin.index') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.index') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>

                </svg>
                Dashboard
            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('admin.settings')}}"
               class="{{request()->routeIs('admin.settings') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.settings') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"/>
                </svg>
                Marketplace Settings
            </a>

        <li class="mr-2">
            <a href="{{route('admin.messages.mass')}}"
               class="{{request()->routeIs('admin.messages.mass') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.messages.mass') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z"/>
                    <path
                        d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1zM3 15a2 2 0 114 0 2 2 0 01-4 0z"/>
                </svg>
                Mass Message
            </a>
        </li>

        <li class="mr-2">
            <a href="{{route('admin.users')}}"
               class="{{request()->routeIs('admin.users') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.users') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                Users
            </a>
        </li>

        <li class="mr-2">
            <a href="{{route('admin.reviews')}}"
               class="{{request()->routeIs('admin.reviews') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.reviews') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
                Reviews
            </a>
        </li>
        <li class="mr-2">
            <a href="{{route('admin.tickets')}}"
               class="{{request()->routeIs('admin.tickets') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">                <svg
                    class="{{request()->routeIs('admin.tickets') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                    <path
                        d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
                </svg>
                Tickets
            </a>
        </li>
    </ul>
</div>
