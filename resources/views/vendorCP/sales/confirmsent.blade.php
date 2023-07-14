<x-layout>
    <x-slot name="content">
        <x-vendorCP.tabmenu/>
        This action can't be undone! Confirm that you have sent <strong>{{ $sale -> offer -> product -> name }}</strong> in quantity of <em>{{ $sale -> quantity }}</em>
        <br>
        Purchase ID: {{ $sale -> short_id }}
        <br>
        <a href="{{route('profile.sales.sent', $sale)}}">Yeah i confirm!</a>
    </x-slot>
</x-layout>
