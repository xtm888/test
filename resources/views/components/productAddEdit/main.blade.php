<x-layout>
    <x-slot name="content">
        @if(request()->is('admin/product/*'))<x-adminCP.tabmenu/> @else <x-vendorCP.tabmenu/>@endif
        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>

        <div class="max-w-7xl mx-auto mt-10">
            @include('components.productAddEdit.titleandsteps')
            {{$productform}}
        </div>
    </x-slot>
</x-layout>
