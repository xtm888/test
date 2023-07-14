{{--<x-productAddEdit.main :basicProduct="$basicProduct">--}}
{{--<x-productAddEdit.main :basicProduct="$basicProduct">--}}
{{--    <x-slot name="productform">--}}

{{--        @include('components/productAddEdit/digitalform')--}}

{{--    </x-slot>--}}
{{--</x-productAddEdit.main>--}}


@if(request()->path() == "profile/vendor/product/digital/add")
    <x-productAddEdit.main>
        <x-slot name="productform">

            @include('components/productAddEdit/digitalform')

        </x-slot>
    </x-productAddEdit.main>
@else
    <x-productAddEdit.main :basicProduct="$basicProduct">
        <x-slot name="productform">

            @include('components/productAddEdit/digitalform')

        </x-slot>
    </x-productAddEdit.main>
@endif
