<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
    <div class="container text-center p-5">
        @if (Route::has('login'))
            <div class="row offset-md-3 col-6">
                @auth
                    <div class="col-12">
                        <a href="{{ url('/home') }}">
                            <h1>Home</h1>
                        </a>
                    </div>
                @else
                    <div class="col-6">
                        <a href="{{ route('login') }}">
                            <h1>Log in</h1>
                        </a>
                    </div>

                    @if (Route::has('register'))
                        <div class="col-6">
                            <a href="{{ route('register') }}">
                                <h1>Register</h1>
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        @endif
        <img class="mt-4" src="{{ asset('icon/back.jpg') }}" alt="" width="600px" height="450px">
    </div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-git.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>

</html>
