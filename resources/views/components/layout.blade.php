<!DOCTYPE html>
@if(request()->session()->exists('white'))
    <html lang="en" data-theme="fantasy">
    @else
        <html lang="en" class="dark" data-theme="night">
        @endif
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">

            @if (isset($title) && $title != null)
                <title>{{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}} - {{ $title }}</title>
            @else
                <title>{{Cache::tags(['MarketPlace'])->get('MPCACHE')->name}}</title>
            @endif

        </head>
        <body>
        <x-flash.error/>
        <x-flash.success/>
        @include('components._navbar')
        {{$content}}
        @include('components._footer')
        </body>
        </html>
