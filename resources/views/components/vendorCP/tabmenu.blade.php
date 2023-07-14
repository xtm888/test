<div class="border-b border-gray-200 dark:border-gray-200 p-2 flex flex-col items-center mb-10">
    <ul class="flex flex-wrap -mb-px justify-center space-x-4">

        <li class="mr-2">
            <a href="{{route('profile.vendor')}}"
               class="{{request()->routeIs('profile.vendor') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.vendor') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                          clip-rule="evenodd"/>
                </svg>

                Market Profile
            </a>
        </li>


        <li class="mr-2">
            <a href="{{route('profile.vendor.settings')}}"
               class="{{request()->routeIs('profile.vendor.settings') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.vendor.settings') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                          clip-rule="evenodd"/>
                </svg>
                Market Settings
            </a>
        </li>


        <li class="mr-2">
            <a href="{{route('profile.vendor.listeditem')}}"
               class="{{request()->routeIs('profile.vendor.listeditem') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.vendor.listeditem') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z"
                          clip-rule="evenodd"/>
                </svg>

                Listed Items
            </a>
        </li>

        <li class="mr-2">
            <a href="{{route('profile.vendor.receivedorders')}}"
               class="{{request()->routeIs('profile.vendor.receivedorders') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.vendor.receivedorders') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>

                Sales
            </a>
        </li>


        <li class="mr-2">
            <a href="{{route('profile.vendor.additem')}}"
               class="{{request()->routeIs('profile.vendor.additem') ? 'text-blue-600 font-bold dark:text-zinc-100 dark:bg-pink-900' : 'dark:text-gray-200 text-gray-600 dark:text-gray-200 hover:text-gray-700 hover:border-gray-300 font-medium border-b-2'}} inline-flex py-4 px-4 text-sm text-center rounded-2xl hover:rounded-sm  border-transparent dark:text-gray-400 dark:hover:text-gray-300 group">
                <svg
                    class="{{request()->routeIs('profile.vendor.additem') ? 'text-blue-400 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500'}} mr-2 w-5 h-5 dark:text-gray-500 dark:group-hover:text-gray-300"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                Add Item
            </a>
        </li>

    </ul>
</div>
