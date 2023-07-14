<div class="row">
    <div class="col-md-12">
        <h3 class="mb-3">@yield('purchase-title')
            </h3>
        <p class="text-muted">Created {{ $purchase -> timeDiff() }} - {{ $purchase -> created_at }}</p>
    </div>

</div>

{{--@if($purchase->status_notification !== null)--}}
{{--    <div class="row">--}}
{{--        <div class="col">--}}
{{--            <div class="alert alert-danger">--}}
{{--                {{$purchase->status_notification}}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
<div class="row">
    @include('components.sales.__offer')
    @include('components.sales.__delivery')
</div>
<div class="row">
    @include('components.sales.__message')
    @include('components.sales.__payment')
</div>
<div class="row">
    @include('components.sales.__feedback')
</div>
<div class="row">
    @include('components.sales.__dispute')
</div>
