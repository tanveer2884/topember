<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.favicons')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Styles -->
    @include('layouts.css')
</head>
    <body>
    <div id="app" class="h-100 login">
        <main class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-md-8 right m-0 p-0">
                    <img src="{{ asset('images/admin/logo.jpeg') }}" class="big-size-img" alt="">
                </div>
                <div class="col-md-4 h-100 m-0 p-0">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}
</body>
</html>
