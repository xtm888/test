@php
    if(empty($type))
        $type = session('product_type');
@endphp

<div>
    <h1 class="p-2 mx-auto mb-10 text-center font-black text-gray-700 dark:text-purple-500 text-2xl border-b-2 border-black border-dashed dark:border-purple-400 max-w-fit">
        @if(request() -> is('profile/vendor/product/edit/*' , 'admin/product/*'))
            @if($type == 'physical')
                EDIT PHYSICAL ITEM
            @else
                EDIT DIGITAL ITEM
            @endif
        @else
            @if($type == 'physical')
                ADD PHYSICAL ITEM
            @else
                ADD DIGITAL ITEM
            @endif
        @endif
    </h1>
    <div class="grid grid-cols-12 lg:grid-cols-11">
        <a class="col-span-3 lg:col-span-2 text-center px-6"
           href="
           @if(request() -> is('profile/vendor/product/edit/*'))
           {{route('profile.vendor.product.edit', $basicProduct)}}
           @elseif(request() -> is('admin/product/*'))
           {{route('admin.product.edit', $basicProduct)}}
           @else
           {{route('profile.vendor.product.add', session('product_type'))}}
           @endif
               ">
            <div
                class="bg-gray-300 dark:bg-indigo-700 rounded-lg flex items-center justify-center border border-gray-200"
            >
                <div
                    class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                         fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path
                            d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                    </svg>
                </div>
                <div
                    class="w-2/3 bg-gray-200 dark:bg-blue-100 h-24 hidden lg:flex lg:block flex-col items-center justify-center px-1 rounded-r-lg body-step"
                >
                    <h2 class="font-bold text-sm dark:text-black">Information</h2>
                    <p class="text-xs text-gray-600">
                        Basic information for product
                    </p>
                </div>
            </div>
        </a>

        <div class="flex-1 hidden lg:flex lg:block items-center justify-center dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                 fill="currentColor">
                <rect fill="none" height="24" width="24"/>
                <path d="M15,5l-1.41,1.41L18.17,11H2V13h16.17l-4.59,4.59L15,19l7-7L15,5z"/>
            </svg>
        </div>

        <a class="col-span-3 lg:col-span-2 text-center px-6"
           href="
           @if(request() -> is('profile/vendor/product/edit/*'))
           {{route('profile.vendor.product.edit', [$basicProduct, 'offers'])}}
           @elseif(request() -> is('admin/product/*'))
           {{route('admin.product.edit', [$basicProduct, 'offers'])}}
           @else
           {{route('profile.vendor.product.offers')}}
           @endif
               ">
            <div
                class="bg-gray-300 dark:bg-indigo-700 rounded-lg flex items-center justify-center border border-gray-200"
            >
                <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                         fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z"/>
                    </svg>
                </div>
                <div
                    class="w-2/3 bg-gray-200 dark:bg-blue-100 h-24  hidden lg:flex lg:block flex-col items-center justify-center px-1 rounded-r-lg body-step"
                >
                    <h2 class="font-bold text-sm dark:text-black">Price & Offers</h2>
                    <p class="text-xs text-gray-600">
                        Set price and offers
                    </p>
                </div>
            </div>
        </a>

        <div class="flex-1 hidden lg:flex lg:block items-center justify-center dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                 viewBox="0 0 24 24" width="36px" fill="currentColor">
                <rect fill="none" height="24" width="24"/>
                <path d="M15,5l-1.41,1.41L18.17,11H2V13h16.17l-4.59,4.59L15,19l7-7L15,5z"/>
            </svg>
        </div>

        @if($type == 'physical')
            <a class="col-span-3 lg:col-span-2 text-center px-6"
               href="
               @if(request() -> is('profile/vendor/product/edit/*'))
               {{route('profile.vendor.product.edit', [$basicProduct, 'delivery'])}}
               @elseif(request() -> is('admin/product/*'))
               {{route('admin.product.edit', [$basicProduct, 'delivery'])}}
               @else
               {{route('profile.vendor.product.delivery')}}
               @endif
                   ">
                <div
                    class="bg-gray-300 dark:bg-indigo-700 rounded-lg flex items-center justify-center border border-gray-200"
                >
                    <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                             fill="#000000">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path
                                d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zm-.5 1.5l1.96 2.5H17V9.5h2.5zM6 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2.22-3c-.55-.61-1.33-1-2.22-1s-1.67.39-2.22 1H3V6h12v9H8.22zM18 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
                        </svg>
                    </div>
                    <div
                        class="w-2/3 bg-gray-200 dark:bg-blue-100 h-24 hidden lg:flex lg:block flex-col items-center justify-center px-1 rounded-r-lg body-step"
                    >
                        <h2 class="font-bold text-sm dark:text-black">Delivery Options</h2>
                        <p class="text-xs text-gray-600">
                            Set shipping conditions
                        </p>
                    </div>
                </div>
            </a>
        @else
            <a class="col-span-3 lg:col-span-2 text-center px-6"
               href="
               @if(request() -> is('profile/vendor/product/edit/*'))
               {{route('profile.vendor.product.edit', [$basicProduct, 'digital'])}}
               @elseif(request() -> is('admin/product/*'))
               {{route('admin.product.edit', [$basicProduct, 'digital'])}}
               @else
               {{route('profile.vendor.product.digital')}}
               @endif
                   ">
                <div
                    class="bg-gray-300 dark:bg-indigo-700 rounded-lg flex items-center justify-center border border-gray-200"
                >
                    <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                             viewBox="0 0 20 20" width="36px" fill="#000000">
                            <rect fill="none" height="20" width="20"/>
                            <g>
                                <path
                                    d="M18,10.5v3c0,0.83-0.67,1.5-1.5,1.5H13l1,1v1H6v-1l1-1H3.5C2.67,15,2,14.33,2,13.5v-9C2,3.67,2.67,3,3.5,3h6.75v1.5H3.5v9 h13v-3H18z M16.5,9l-1.06-1.06l-2.19,2.19V3h-1.5v7.13L9.56,7.94L8.5,9l4,4L16.5,9z"/>
                            </g>
                        </svg>
                    </div>
                    <div
                        class="w-2/3 bg-gray-200  dark:bg-blue-100 h-24 hidden lg:flex lg:block flex-col items-center justify-center px-1 rounded-r-lg body-step"
                    >
                        <h2 class="font-bold text-sm dark:text-black">Digital Options</h2>
                        <p class="text-xs text-gray-600">
                            Autodelivery setup
                        </p>
                    </div>
                </div>
            </a>
        @endif

        <div class="flex-1 hidden lg:flex lg:block items-center justify-center dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" height="36px"
                 viewBox="0 0 24 24" width="36px" fill="currentColor">
                <rect fill="none" height="24" width="24"/>
                <path d="M15,5l-1.41,1.41L18.17,11H2V13h16.17l-4.59,4.59L15,19l7-7L15,5z"/>
            </svg>
        </div>

        <a class="col-span-3 lg:col-span-2 text-center px-6"
           href="
           @if(request() -> is('profile/vendor/product/edit/*'))
           {{route('profile.vendor.product.edit', [$basicProduct, 'images'])}}
           @elseif(request() -> is('admin/product/*'))
           {{route('admin.product.edit', [$basicProduct, 'images'])}}
           @else
           {{route('profile.vendor.product.images')}}
           @endif
               ">
            <div
                class="bg-gray-300 dark:bg-indigo-700 rounded-lg flex items-center justify-center border border-gray-200"
            >
                <div class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px"
                         fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path
                            d="M2 6H0v5h.01L0 20c0 1.1.9 2 2 2h18v-2H2V6zm5 9h14l-3.5-4.5-2.5 3.01L11.5 9zM22 4h-8l-2-2H6c-1.1 0-1.99.9-1.99 2L4 16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 12H6V4h5.17l1.41 1.41.59.59H22v10z"/>
                    </svg>
                </div>
                <div
                    class="w-2/3 bg-gray-200 dark:bg-blue-100 h-24 hidden lg:flex lg:block flex-col items-center justify-center px-1 rounded-r-lg body-step"
                >
                    <h2 class="font-bold text-sm dark:text-black">Images & Video</h2>
                    <p class="text-xs text-gray-600">
                        Make your presentation!
                    </p>
                </div>
            </div>
        </a>
    </div>
</div>
