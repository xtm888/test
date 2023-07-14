<form
    action="{{ route('profile.vendor.product.add.post', optional($basicProduct) -> exists ? $basicProduct : null) }}"
    method="POST">
    @csrf
    <div class="border mt-8 mx-auto w-9/12 rounded-lg">
        <div class="mx-auto grid grid-cols-6 gap-3 mx-4 p-3">
            <div class="col-span-3">
                <x-form.input name="name" label="Product Name" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"
                              value="{{ optional($basicProduct) -> name }}"/>
            </div>
            <div class="col-span-3">
                <label class="flex flex-none text-grey-darker text-sm font-bold mb-2 items-center"
                       for="category">
                    Category
                </label>
                <select
                    class="form-select appearance-none w-full py-2 px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Category" name="category" id="category" required>
                    <option value="" disabled selected hidden>Choose Category</option>
                    @foreach($allCategories as $category)
                        <option disabled>> {{$category->name}}</option>
                        @if ($category->children->count())
                            @foreach($category->children as $subCategories)
                                <option value="{{$subCategories->name}}"
                                        @if($subCategories -> id == optional($basicProduct) -> category_id) selected @endif>
                                    {{$subCategories->name}}</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-span-6">
                <x-form.textarea name="description" class="appearance-none border rounded w-full py-2 px-3 dark:text-gray-200 dark:text-black"
                                 rows="7">{{ optional($basicProduct) -> description }}</x-form.textarea>
            </div>
            <div class="col-span-6">
                <x-form.textarea name="rules" class="appearance-none border rounded w-full py-2 px-3 dark:text-gray-200 dark:text-black"
                                 rows="5">{{ optional($basicProduct) -> rules }}</x-form.textarea>
            </div>
            <div class="col-span-3">
                <label for="quantity" class="block text-grey-darker text-sm font-bold mb-2">
                    Quantity
                </label>

                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-200 dark:text-black"
                       type="number"
                       name="quantity"
                       id="quantity"
                       min="1"
                       value="{{ optional($basicProduct) -> quantity }}"
                >
            </div>
            <div class="col-span-3">
                <label class="flex flex-none text-grey-darker text-sm font-bold mb-2 items-center"
                       for="mesure">
                    Mesure
                </label>
                <select
                    class="form-select appearance-none w-full py-2 px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Mesure" name="mesure" id="mesure" required>
                    <option value="" disabled selected hidden>Count type of your product</option>
                    <option value="piece"
                            @if('piece' == optional($basicProduct) -> count_type) selected @endif>Piece
                        (E.g: 10x Sugar Cube)
                    </option>
                    <option value="gram"
                            @if('gram' == optional($basicProduct) -> count_type) selected @endif>Gram (E.g:
                        125gram Green Tea)
                    </option>
                    <option value="milliliter"
                            @if('milliliter' == optional($basicProduct) -> count_type) selected @endif>
                        Milliliter (E.g: 300ml Cough Syrup)
                    </option>
                    <option value="cc" @if('cc' == optional($basicProduct) -> count_type) selected @endif>CC
                        (E.g: 50cc Metalic Yellow Dye)
                    </option>
                </select>
            </div>
        </div>
    </div>
    {{--form end--}}
    {{--button start--}}
    <div class="mt-4 mx-auto w-9/12 flex justify-between">

        @if(!request()->is('profile/vendor/product/edit/*/section'))
            <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
                Back
            </button>
        @endif
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            @if(request()->is('profile/vendor/product/edit/*'))
                Save
            @else
                Next
            @endif
            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</form>
