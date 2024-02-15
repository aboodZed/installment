<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('text.appname') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('icon/logo.png') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container text-center p-5 row">
        <div class="col-6 mt-3 p-5">
            <h1>{{ __('text.appname') }}</h1>
            <img class="mt-5 mb-5" src="{{ asset('icon/logo.png') }}" alt="logo" width="100px" height="100px">
            @auth
                <div>
                    <a href="{{ url('/home') }}">
                        <button class="btn btn-primary">
                            <b style="color: white; padding: 30px">{{ __('text.home') }}</b>
                        </button>
                    </a>
                </div>
            @else
                @if (Route::has('login'))
                    <div>
                        <a href="{{ route('login') }}">
                            <button class="btn btn-primary">
                                <b style="color: white; padding: 30px">{{ __('text.login') }}</b>
                            </button>
                        </a>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="mt-3">
                        <a href="{{ route('register') }}">
                            <button class="btn btn-primary">
                                <b style="color: white; padding: 30px">{{ __('text.register') }}</b>
                            </button>
                        </a>
                    </div>
                @endif
            @endauth
        </div>
        <div class="col-6 mt-3">
            <img src="{{ asset('icon/back.jpg') }}" alt="" width="650px" height="450px">
        </div>
    </div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-git.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>

</html>
