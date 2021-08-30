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
    @include('layouts.livewirejs')
    @include('frontend.layouts.toastr-events')
    @stack('page_js')

<script>
    // scroll animation
    $(function() {
        $('a[href*=\\#]:not([href=\\#])').on('click', function() {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.substr(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
                return false;
            }
        });
    });
    // scroll animation
    $('.close-alert').click(function() {
        $('.alert').hide();
    });
    $('.consultation-butn').click(function() {

        $('html,body').animate({
            scrollTop: $('.success-message').offset().top -100
        }, 500);
        $("#consult-form").trigger('reset');
        setTimeout(function() {
            $('.alert').show();
        }, 100);
        return false;
    });
</script>
</body>

</html>
