<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <img src="{{ asset('img/logo.jpg') }}" width="35" height="35" class="mr-3 rounded d-inline-block align-top" alt="{{ config('app.name', 'Laravel') }}">
                <a class="navbar-brand mr-auto mr-lg-0" href="#">
                    {{ config('app.name', 'Laravel') }} {{ $currentUser->cannot('on-kiosk', $currentUser) ? '' : ' - Kiosk' }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        &nbsp;
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                {{ ucfirst($currentUser->name) }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="text-danger nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fe fe-power"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="nav-scroller bg-white shadow-sm">
                <nav class="nav nav-underline">

                </nav>
            </div>

            <main role="main">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <span class="copyright">&copy; {{ date('Y') }}, {{ config('app.name') }}</span>

                    <div class="float-right">
                        <span class="copyright">v1.0.0</span>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
