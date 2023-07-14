{{--@extends('admin.product.edit')--}}

{{--@if(request() -> is('profile/vendor/product/edit/*'))--}}
{{--    @section('product-title', 'Edit product - '. $basicProduct -> name)--}}
{{--@else--}}
{{--    @section('product-title', 'Add ' . session('product_type') . ' product')--}}
{{--@endif--}}

{{--@section('product-images-form')--}}
{{--    @include('includes.profile.imagesform')--}}
{{--@endsection--}}


<x-productAddEdit.main :basicProduct="$basicProduct">
    <x-slot name="productform">

        @include('components/productAddEdit/imagesform')

    </x-slot>
</x-productAddEdit.main>
