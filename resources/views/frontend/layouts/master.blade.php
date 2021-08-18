<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} | @yield('title') </title>

    <meta charset="UTF-8">
    <meta name="author" content="Box Store">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image','/images/logo.png')">
    <meta property="og:url" content="@yield('url',request()->url())">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('image','/images/logo.png')">

    @include('frontend.layouts.css')
    @stack('page_css')
    @livewireStyles
</head>

<body>
    <!-- header  -->
    @include('frontend.layouts.header')
    <!-- header  -->

    <div class="clearfix"></div>

    <div class="inner-section">

        @yield('page')

    </div>

    <div class="clearfix"></div>

    @include('frontend.layouts.footer')


    @include('frontend.layouts.js')
    @livewireScripts
    @stack('page_js')
</body>

</html>
