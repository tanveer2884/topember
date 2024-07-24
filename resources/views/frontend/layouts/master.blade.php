<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('meta_title', $title ?? '') | {{ config('app.name') }} </title>
    <link rel="icon" sizes="57x57" href="/frontend/images/fav-icon.png">

    <meta charset="UTF-8">
    <meta name="author" content="Box Store">
    <meta name="robots" content="index, follow">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=1.0, minimum-scale=1.0, maximum-scale=3.0">

    <meta name="description" content="@yield('description', $description ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $keywords ?? '')">
    <meta property="og:title" content="@yield('meta_title')">
    <meta property="og:description" content=@yield('meta_description')>
    <meta property="og:image" content="@yield('image', '/frontend/images/logo.png')">
    <meta property="og:url" content="@yield('url', request()->url())">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('image', '/images/logo.png')">

    @include('frontend.layouts.css')
    @stack('page_css')

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="90">

    <!-- Preloader -->
    <div class="loader" id="loader-fade">
        <div class="linear-activity">
            <div class="indeterminate"></div>
        </div>
    </div>
    <!-- Preloader End -->
    @include('frontend.layouts.header')

    @yield('page')
    {{ $slot ?? '' }}
    <!--Animated Cursor-->
    <div id="animated-cursor">
        <div id="cursor">
            <div id="cursor-loader"></div>
        </div>
    </div>

    
    @include('frontend.layouts.js')
    @include('frontend.layouts.livewirejs')
    @include('frontend.layouts.toastr-events')
    @stack('page_js')

</body>

</html>