<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    @include('layouts.favicons')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
    @stack('css')
    @livewireStyles
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern menu-expanded 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <x-nav-bar></x-nav-bar>

    <x-user-menu></x-user-menu>

    <!-- BEGIN: Content-->
    <div class="app-content content" style="overflow-y: visible;">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="content-header row">
                    <div class="col-md-12">
                        <x-flash-message></x-flash-message>
                    </div>
                </div>
                @yield('page')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('layouts.footer')
    @include('layouts.js')
    @livewireScripts
    @stack('js')
    @include('layouts.livewirejs')
    @stack('lvjs')
    <x-modal />
</body>
<!-- END: Body-->

</html>