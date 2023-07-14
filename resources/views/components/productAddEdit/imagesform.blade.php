{{--            start form section--}}
<form action="{{ route('profile.vendor.product.images.post', $basicProduct) }}" method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="border mt-8 mx-auto w-9/12 rounded-lg">

        @if(!empty($productsImages ?? []))
            <div class="flex flex-row gap-3">
                @foreach($productsImages as $image)
                    <div class=" m-3 p-2 @if($image -> first) bg-success @endif">
                        <img class="w-48" src="{{ asset('storage/' . $image -> image) }}" alt="Product image">
                        <div class="mt-4 text-center">
                            @if(!$image -> first)
                                <a href="{{ route('profile.vendor.product.images.default', $image -> id) }}" class="btn btn-sm btn-primary">Default</a>
                                <a href="{{ route('profile.vendor.product.images.remove', $image -> id) }}" class="btn btn-sm btn-danger">Delete</a>
                            @else
                                <p class="bg-white text-gray-600">Default picture</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-11/12 mx-auto mt-3 alert alert-warning">
                <p class="mx-auto font-bold">You don't have any images added, it must be at least one!</p>
            </div>
        @endif

        <div class="mx-auto grid grid-cols-6 gap-3 mx-4 p-3">

            <div class="col-span-4 md:col-span-3">
                <label class="block mb-2 text-md font-medium text-gray-900 dark:text-gray-300"
                       for="picture">Upload Product Image</label>
                <input
                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent file:bg-gray-800 file:px-3 file:text-white file:rounded-lg file:mr-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3 "
                    name="picture" id="picture" type="file">
            </div>

            <div class="col-span-2 md:col-span-1 mt-10 ml-5">
                <div class="flex items-center">
                    <input id="defaultcheck" type="checkbox" name="first" value="1"
                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="defaultcheck"
                           class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Default</label>
                </div>
            </div>

            <div class="md:ml-8 col-span-2 md:col-span-1 mx-auto md:mt-7">
                <button type="submit"
                        class="whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Image
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>
</form>
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

    @vendor
    @if(!request() -> is('profile/vendor/product/edit/*'))
        <form method="POST" action="{{ route("profile.vendor.product.post") }}">
            @csrf
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add Product
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </form>
    @endif
    @endvendor

</div>
