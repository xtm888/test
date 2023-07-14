{{--@extends('admin.product.edit')--}}

{{--@section('product-title', 'Edit product - '. $basicProduct -> name)--}}

{{--@section('product-basic-form')--}}
{{--    @include('includes.profile.basicform')--}}
{{--@endsection--}}

<x-productAddEdit.main :basicProduct="$basicProduct">
    <x-slot name="productform">

        @include('components/productAddEdit/basicform')

    </x-slot>
</x-productAddEdit.main>
