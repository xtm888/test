<div class="border mt-8 mx-auto w-9/12 rounded-lg">

    {{--                    start shippings table--}}
    @if(!empty($productsShipping))
        <div class="flex flex-col mx-auto mx-6 mt-4">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-lg sm:rounded-md">
                        <table class="min-w-full">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Name
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Price
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Duration
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Minimum quantity
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Maximum quantity
                                </th>
                                <th scope="col" class="relative py-3 px-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($productsShipping as $shipping)
                                <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $shipping -> name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $shipping -> price }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $shipping -> duration }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $shipping -> from_quantity }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $shipping -> to_quantity }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        {{--                                        <a href="{{ route('profile.vendor.product.delivery.remove', [$shipping -> id, $physicalProduct] ) }}"--}}
                                        {{--                                           class="text-blue-600 dark:text-blue-500 hover:underline">Delete</a>--}}
                                        @if($shipping -> exists)
                                            <a href="{{ route('profile.vendor.product.delivery.remove', [$shipping -> id, $physicalProduct] ) }}"
                                               class="btn btn-sm btn-outline-danger">Remove</a>
                                        @else
                                            <a href="{{ route('profile.vendor.product.delivery.remove', $i) }}"
                                               class="btn btn-sm btn-outline-danger">Remove</a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--    @else--}}
        {{--        You don't have any offer please add at--}}
        {{--        least one!--}}
    @endif

    {{--                    end shippings table--}}

    {{--            start form shipping details section--}}
    <form
        action="{{ route('profile.vendor.product.delivery.new', $physicalProduct -> product) }}"
        method="POST">
        @csrf
        <div class="mx-auto grid grid-cols-12 gap-3 mx-4 p-3 mt-5">
            <div class="col-span-4">
                <x-form.input name="name" labelhidden="true" placeholder="Name"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
            </div>
            <div class="col-span-4">
                <x-form.input name="price" labelhidden="true" placeholder="Cost"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
            </div>
            <div class="col-span-4">
                <x-form.input name="duration" labelhidden="true" placeholder="Duration"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
            </div>
            <div class="col-span-3 sm:col-span-4">
                <x-form.input name="from_quantity" labelhidden="true" placeholder="Minimum quantity"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
            </div>
            <div class="col-span-3 sm:col-span-4">
                <x-form.input name="to_quantity" labelhidden="true" placeholder="Maximum quantity"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"/>
            </div>
            <div class="lg:col-span-2 lg:ml-5 col-span-1 mx-auto">
                <button type="submit"
                        class="whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Shipping
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
    {{--form end--}}

    {{--                shipping where to where form--}}
    <form method="POST" action="{{ route('profile.vendor.product.delivery.options', $physicalProduct) }}">
        @csrf
        <div class="mx-auto grid grid-cols-10 gap-3 mx-4 p-3 mt-1">
            <div class="col-span-5">
                <x-form.input name="country_from" label="Shipping From"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"
                              placeholder="Eg: Spain, England, Turkey"
                              :value="old('country_from',$physicalProduct->country_from)"/>
            </div>
            <div class="col-span-5">
                <x-form.input name="countries" label="Shipping To"
                              class="appearance-none border rounded w-full py-2 px-3 text-grey-darker dark:text-black"
                              placeholder="Eg: WW, Asia, Turkey" :value="old('countries',$physicalProduct->countries)"/>
            </div>
        </div>
</div>


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
        <button class="btn btn-outline-success" type="submit">Save</button>
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
        <button class="btn btn-outline-success" type="submit">Save</button>
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
