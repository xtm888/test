{{--<x-productAddEdit.main :basicProduct="$basicProduct">--}}

{{--<x-productAddEdit.main {{ request()->path() == "/profile/vendor/product/delivery/add" ? '' : ':basicProduct="$basicProduct"' }} >--}}


    @if(request()->path() == "profile/vendor/product/delivery/add")
        <x-productAddEdit.main>
            <x-slot name="productform">

                @include('components/productAddEdit/deliveryform')

            </x-slot>
        </x-productAddEdit.main>
    @else
        <x-productAddEdit.main :basicProduct="$basicProduct">
            <x-slot name="productform">

                @include('components/productAddEdit/deliveryform')

            </x-slot>
        </x-productAddEdit.main>
    @endif


