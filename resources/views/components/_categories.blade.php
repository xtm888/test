{{--<div class="lg:sticky lg:top-4">--}}
<div class="lg:sticky lg:top-4">
    <details open class="overflow-hidden border border-gray-200 rounded ">

{{--        <summary class="flex items-center justify-between px-5 py-3 bg-gray-100 lg:hidden">--}}
{{--          <span class="text-sm font-medium">--}}
{{--            Categories--}}
{{--          </span>--}}

{{--            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                 stroke="currentColor">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                      d="M4 6h16M4 12h16M4 18h16"/>--}}
{{--            </svg>--}}
{{--        </summary>--}}

        <summary class="hidden"></summary>

        <div
            class="border-t border-gray-200 lg:border-t-0"
        >
            <fieldset>
                <legend class="block w-full px-5 py-3 text-sm font-medium bg-gray-50 dark:bg-yellow-600 dark:text-black">
                    Physical Products
                </legend>

                {{--                 TODO:  space-y-categoryCount--}}
                <div class="px-5 py-6 space-y-3">
                    @foreach($categories->where('type','physical') as $category)
                        <details class="w-full bg-white dark:bg-black border mb-3">
                            <summary
                                class="cursor-pointer w-full bg-white text-dark dark:bg-gray-900 dark:text-white flex justify-between px-4 py-3  after:content-['>'] select-none">
                                {{$category->name}}
                            </summary>
                            {{--                 TODO:  space-y-subCategoryCount--}}
                            @foreach($category->children as $subCategory)
                                <ul class="list-disc px-8 py-3 space-y-3">
                                    <li>
                                        <a href="{{route('category.show', $subCategory->id)}}">{{$subCategory->name}}</a>
                                    </li>
                                </ul>
                            @endforeach
                        </details>
                    @endforeach
                </div>
            </fieldset>

            <div>
                <fieldset>
                    <legend class="block w-full px-5 py-3 text-sm font-medium bg-gray-50 dark:bg-yellow-600 dark:text-black">
                        Digital Products
                    </legend>

                    <div class="px-5 py-6 space-y-3">
                        @foreach($categories->where('type','digital') as $category)
                            <details class="w-full bg-white dark:bg-black border mb-3">
                                <summary
                                    class="cursor-pointer w-full bg-white text-dark dark:bg-gray-900 dark:text-white flex justify-between px-4 py-3  after:content-['>'] select-none">
                                    {{$category->name}}
                                </summary>
                                @foreach($category->children as $subCategory)
                                    <ul class="list-disc px-8 py-3 space-y-3">
                                        <li>
                                            <a href="{{route('category.show', $subCategory->id)}}">{{$subCategory->name}}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            </details>
                        @endforeach

                    </div>
                </fieldset>
                <form class="mb-0 lg:flex mx-5" action="/" method="GET">
                    <div class="relative mx-auto">
                        <x-form.input name="search" labelhidden="true" placeholder="Search" value="{{ request('search') }}"/>

                        <button class="absolute inset-y-0 right-0 p-2 mb-3 mr-px text-gray-600 rounded-r-lg"
                                type="submit">
                            <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    clip-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    fill-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>


            {{--            <div class="flex justify-between px-5 py-3 border-t border-gray-200">--}}
            {{--                <button--}}
            {{--                    name="reset"--}}
            {{--                    type="button"--}}
            {{--                    class="text-xs font-medium text-gray-600 underline rounded"--}}
            {{--                >--}}
            {{--                    Reset All--}}
            {{--                </button>--}}

            {{--                <button--}}
            {{--                    name="commit"--}}
            {{--                    type="button"--}}
            {{--                    class="px-5 py-3 text-xs font-medium text-white bg-green-600 rounded"--}}
            {{--                >--}}
            {{--                    Apply Filters--}}
            {{--                </button>--}}
            {{--            </div>--}}
        </div>
    </details>
</div>


{{--was working--}}
{{--<div class="lg:sticky lg:top-4">--}}
{{--    <details--}}
{{--        open--}}
{{--        class="overflow-hidden border border-gray-200 rounded"--}}
{{--    >--}}

{{--        <summary class="flex items-center justify-between px-5 py-3 bg-gray-100 lg:hidden">--}}
{{--          <span class="text-sm font-medium">--}}
{{--            Categories--}}
{{--          </span>--}}

{{--            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                 stroke="currentColor">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                      d="M4 6h16M4 12h16M4 18h16"/>--}}
{{--            </svg>--}}
{{--        </summary>--}}


{{--        <div--}}
{{--            class="border-t border-gray-200 lg:border-t-0"--}}
{{--        >--}}
{{--            <fieldset>--}}
{{--                <legend class="block w-full px-5 py-3 text-xs font-medium bg-gray-50">--}}
{{--                    Physical Products--}}
{{--                </legend>--}}

{{--                --}}{{--                 TODO:  space-y-categoryCount--}}
{{--                <div class="px-5 py-6 space-y-3">--}}
{{--                    @foreach($categories->where('type','physical') as $category)--}}
{{--                        <details class="w-full bg-white border mb-3">--}}
{{--                            <summary--}}
{{--                                class="cursor-pointer w-full bg-white text-dark flex justify-between px-4 py-3  after:content-['>']">--}}
{{--                                {{$category->name}}--}}
{{--                            </summary>--}}
{{--                            --}}{{--                 TODO:  space-y-subCategoryCount--}}
{{--                            @if($category->children->count())--}}
{{--                                @foreach($category->children as $subCategory)--}}
{{--                                    <ul class="list-disc px-8 py-3 space-y-3">--}}
{{--                                        <li><a href="#">{{$subCategory->name}}</a></li>--}}
{{--                                    </ul>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </details>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </fieldset>--}}

{{--            <div>--}}
{{--                <fieldset>--}}
{{--                    <legend class="block w-full px-5 py-3 text-xs font-medium bg-gray-50">--}}
{{--                        Digital Products--}}
{{--                    </legend>--}}

{{--                    <div class="px-5 py-6 space-y-3">--}}
{{--                        @foreach($categories->where('type','digital') as $category)--}}
{{--                            <details class="w-full bg-white border mb-3">--}}
{{--                                <summary--}}
{{--                                    class="cursor-pointer w-full bg-white text-dark flex justify-between px-4 py-3  after:content-['>']">--}}
{{--                                    {{$category->name}}--}}
{{--                                </summary>--}}
{{--                                @if($category->children->count())--}}
{{--                                    @foreach($category->children as $subCategory)--}}
{{--                                        <ul class="list-disc px-8 py-3 space-y-3">--}}
{{--                                            <li><a href="#">{{$subCategory->name}}</a></li>--}}
{{--                                        </ul>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </details>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                </fieldset>--}}
{{--                <form class="hidden mb-0 lg:flex">--}}
{{--                    <div class="relative mx-auto">--}}
{{--                        <x-form.input name="search" labelhidden="true" placeholder="Search"/>--}}

{{--                        <button class="absolute inset-y-0 right-0 p-2 mb-3 mr-px text-gray-600 rounded-r-lg"--}}
{{--                                type="submit">--}}
{{--                            <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    clip-rule="evenodd"--}}
{{--                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"--}}
{{--                                    fill-rule="evenodd"--}}
{{--                                ></path>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            --}}{{--            <div class="flex justify-between px-5 py-3 border-t border-gray-200">--}}
{{--            --}}{{--                <button--}}
{{--            --}}{{--                    name="reset"--}}
{{--            --}}{{--                    type="button"--}}
{{--            --}}{{--                    class="text-xs font-medium text-gray-600 underline rounded"--}}
{{--            --}}{{--                >--}}
{{--            --}}{{--                    Reset All--}}
{{--            --}}{{--                </button>--}}

{{--            --}}{{--                <button--}}
{{--            --}}{{--                    name="commit"--}}
{{--            --}}{{--                    type="button"--}}
{{--            --}}{{--                    class="px-5 py-3 text-xs font-medium text-white bg-green-600 rounded"--}}
{{--            --}}{{--                >--}}
{{--            --}}{{--                    Apply Filters--}}
{{--            --}}{{--                </button>--}}
{{--            --}}{{--            </div>--}}
{{--        </div>--}}
{{--    </details>--}}
{{--</div>--}}
