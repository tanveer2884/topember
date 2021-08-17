<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }} | @yield('meta_title') </title>
    <meta name="description" content="@yield('meta_description')">
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
