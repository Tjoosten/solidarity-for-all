<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name') }} </title>

        {{-- Favicons --}}
        <link rel="icon" href="{{  asset('favicon.ico') }}" type="image/x-icon">

        {{-- Javascript --}}
        <script src="{{ asset('js/auth.js') }}" defer></script>

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </head>
    <body class="my-login-page">
        <div id="app">
            @yield('content') {{-- Page content --}}
        </div>
    </body>
</html>
