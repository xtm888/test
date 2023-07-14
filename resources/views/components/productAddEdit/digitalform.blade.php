<form method="POST" action="{{ route('profile.vendor.product.digital.post', $digitalProduct) }}">
    @csrf
    <div class="border mt-8 mx-auto w-9/12 rounded-lg">
        <div class="mx-auto grid grid-cols-6 gap-3 mx-4 p-3">
            <div class="col-span-6">


                @if(request()->is('profile/vendor/product/edit/*') || request()->is('admin/product/*/digital'))
                    <x-form.textarea name="product_content" id="product_content" label="Autodelivery Content"
                                     class="border border-gray-200 p-2 w-full rounded dark:text-black"
                                     rows="5">{{$basicProduct->digital->content}}</x-form.textarea>
                @else
                    <x-form.textarea name="product_content" id="product_content" label="Autodelivery Content"
                                     class="border border-gray-200 p-2 w-full rounded dark:text-black"
                                     rows="5">
                        @if(session('product_details'))
                            {{session('product_details')->content}}
                        @endif
                    </x-form.textarea>
                @endif
            </div>
        </div>
    </div>
    {{--form end--}}
    {{--button start--}}
    <div class="mt-4 mx-auto w-9/12 flex justify-between">

        <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
            </svg>
            Back
        </button>

        @if(request() -> is('profile/vendor/product/edit/*'))
            <button class="btn btn-secondary" type="submit">Save Content</button>
            <div
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <a href="{{ route('profile.vendor.product.edit', [$basicProduct, 'images']) }}">
                    Next

                    <svg class="ml-2 -mr-1 w-5 h-5 inline-block" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        @elseif(request() -> is('admin/product/*'))
            <button class="btn btn-secondary" type="submit">Save Content</button>
            <div
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <a href="{{ route('admin.product.edit', [$basicProduct, 'images']) }}">
                    Next

                    <svg class="ml-2 -mr-1 w-5 h-5 inline-block" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        @else
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Next
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        @endif

    </div>
</form>
