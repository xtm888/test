<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>

        <div class="max-w-4xl mx-auto">

            <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-blue-900 ">
                <div class="grid grid-cols-2 justify-between">
                    <div class="col-span-1 ">
                        <p>Marketplace Name: <span class="font-bold">"{{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}}"</span>
                        </p>
                    </div>
                    <div class="col-span-1 text-right">
                        <form action="{{route('admin.marketname.post')}}" method="POST">
                            @csrf
                            <div class="">
                                <input class="border border-gray-400 dark:text-black rounded"
                                       type="text"
                                       name="marketname"
                                       id="marketname"
                                       required
                                >
                                <button type="submit" class="ml-2 border border-black rounded-md px-1 mt-2 sm:mt-0">
                                    Change
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--            <div class="w-full border border-black rounded-md p-4 my-4">--}}
            {{--                <div class="grid grid-cols-2 justify-between">PGP</div>--}}
            {{--            </div>--}}

            <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-blue-900">

                <details class="w-full bg-white dark:bg-stone-800">
                    <summary
                        class="cursor-pointer w-full bg-white dark:bg-stone-800 text-dark flex justify-between rounded p-4 after:content-['>']">
                        Market PGP Address
                    </summary>
                    <textarea name="decrypt_message" class="w-full p-2 mt-4 dark:bg-gray-700" rows="10"
                              style="resize: none;"
                              readonly>{{ Cache::tags(['MarketPlace'])->get('MPCACHE')->pgp }}</textarea>
                </details>

                <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-blue-900">
                    <div>
                        <p class="border-b max-w-fit border-black">Set New PGP</p>
                    </div>
                    <form action="{{route('admin.marketpgp.post')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <div class="dark:text-black">
                                <x-form.textarea
                                    name="marketpgp" labelhidden="true" rows="7">
                                </x-form.textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Set PGP
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


            <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-blue-900">
                <div class="border-b max-w-fit border-black font-semibold">Categories</div>
                <div class="p-2 mt-1">
                    @foreach($categories as $category)
                        <p class="font-semibold dark:text-yellow-400">{{$category->name}}:
                            @if ($category->children->count())
                                @foreach($category->children as $subCategories)
                                    <span class="font-normal dark:text-yellow-200">{{$subCategories->name}}
                                        @if(!$loop->last)
                                            ,
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        </p>
                    @endforeach
                </div>
                <div class="border-b max-w-fit border-black mt-5 font-semibold">Add Main Category</div>
                <div>
                    <form action="{{route('admin.maincategory.post')}}" method="POST">
                        @csrf
                        <div class="my-4">
                            <input class="border border-gray-400 p-0.5 rounded dark:text-black"
                                   type="text"
                                   name="mainname"
                                   id="mainname"
                                   required
                            >
                            <div class="mt-2 flex flex-shrink-0 ">
                                <label class="flex flex-none text-grey-darker text-sm mb-2 items-center hidden"
                                       for="category">
                                    Type (*):
                                </label>
                                <div class="flex">
                                    <div class="mb-2 flex flex-shrink-0">
                                        <select class="form-select appearance-none
      block w-5/6      px-3      py-1.5      text-base      font-normal      text-gray-700   bg-white bg-clip-padding bg-no-repeat      border border-solid border-gray-300
      rounded      transition      ease-in-out      m-0      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                aria-label="type"
                                                name="type" id="type">
                                            <option value="" disabled selected hidden>Choose Type</option>
                                            <option value="physical">Physical</option>
                                            <option value="digital">Digital</option>
                                        </select>
                                        <button type="submit"
                                                class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="border-b max-w-fit border-black mt-5 font-semibold">Add Child Category</div>
                <div>
                    <form action="{{route('admin.subcategory.post')}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xs my-2">
                            <select class="form-select appearance-none block w-5/6 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border
                            border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="parent"
                                    name="parent" id="parent">
                                <option value="" disabled selected hidden>Choose main category</option>
                                @foreach($categories as $category)
                                    <option>{{$category->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="my-4 ">
                            <input class="border border-gray-400 p-0.5 rounded dark:text-black"
                                   type="text"
                                   name="subname"
                                   id="subname"
                                   required
                            >
                            <button class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Add</button>
                        </div>
                    </form>
                </div>


                <div class="border-b max-w-fit border-black mt-5 font-semibold">Change Category Name</div>
                <div>
                    <form action="{{route('admin.editcategory.post')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="max-w-xs my-2">
                            <select class="form-select appearance-none block w-5/6 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border
                            border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="editcategoryname"
                                    name="editcategoryname" id="editcategoryname">
                                <option value="" disabled selected hidden>Choose category to edit</option>
                                @foreach($categories as $category)
                                    <option class="text-xl" value="{{$category->name}}">>> {{$category->name}}<<
                                    </option>
                                    @if ($category->children->count())
                                        @foreach($category->children as $subCategories)
                                            <option>{{$subCategories->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="my-4 ">
                            <input class="border border-gray-400 p-0.5 rounded dark:text-black"
                                   type="text"
                                   name="putname"
                                   id="putname"
                                   placeholder="set name"
                                   required
                            >
                            <button class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Change</button>
                        </div>
                    </form>
                </div>

                <div class="border-b max-w-fit border-black mt-5 font-semibold">Delete Category</div>
                <div>
                    <form action="{{route('admin.delcategory.post')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="max-w-xs my-2 flex flex-shrink-0">
                            <select class="form-select appearance-none w-5/6 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border
                            border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="category"
                                    name="category" id="category">>
                                <option value="" disabled selected hidden>Choose category</option>
                                @foreach($categories as $category)
                                    <option class="text-xl" value="{{$category->name}}">>> {{$category->name}}<<
                                    </option>
                                    @if ($category->children->count())
                                        @foreach($category->children as $subCategories)
                                            <option>{{$subCategories->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-full border border-black rounded-md p-4 my-12 dark:bg-blue-900 ">
                <div class="flex flex-shrink-0 justify-between">
                    <p class="border-b max-w-fit border-black">Main Page Articles</p>
                    {{--                    <p>(Add)</p>--}}
                </div>
                @foreach(json_decode(Cache::tags(['MarketPlace'])->get('MPCACHE')->articles,true) as $key => $article)
                    <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-stone-900 ">
                        <div class="flex justify-end">
                            <form action="{{route('admin.setpublisharticle.post',$key)}}" method="POST">
                                @csrf
                                <button type="submit" class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">
                                    {{$article['published'] ? 'UnPublish' : 'Publish'}}
                                </button>
                            </form>
                            {{--                            <button type="submit" class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Remove--}}
                            {{--                            </button>--}}
                            <form action="{{route('admin.articlecontent.post',$key)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Save
                                </button>
                        </div>
                        <div class="flex">
                            <p class="font-bold ">Title:</p>
                            <span class="grow">
                            <x-form.input name="article_title" value="{{$article['title']}}" labelhidden="true"
                                          class="appearance-none border rounded w-4/6 text-grey-darker mx-4 dark:text-black"/>
                                </span>
                        </div>
                        <div class="flex">
                            <p class="font-bold ">Body:</p>
                            <span class="grow">
                            <x-form.textarea name="article_description" labelhidden="true"
                                             class="appearance-none border rounded w-4/6 text-grey-darker mx-4 dark:text-black">
                                {{$article['description']}}
                            </x-form.textarea>

                                </span>
                        </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="w-full border border-black rounded-md p-4 my-4 dark:bg-blue-900">
                <div>
                    <p class="border-b max-w-fit border-black">Footer Description</p>
                </div>
                <form action="{{route('admin.footer.post')}}" method="POST">
                    @csrf
                    <div class="mt-3">
                        <div class="dark:text-black">
                            <x-form.textarea
                                name="footer" labelhidden="true" rows="2">
                                {{Cache::tags(['MarketPlace'])->get('MPCACHE')->footer}}
                            </x-form.textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="ml-2 border py-0.5 px-2 rounded-md border-gray-400">Set Footer
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </x-slot>
</x-layout>
