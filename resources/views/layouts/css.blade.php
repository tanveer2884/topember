<title>{{ config('app.name') }}</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/forms/select/select2.min.css') }}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">

{{-- Toggleable Css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">

<!-- BEGIN: Page CSS-->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}"> -->
<!-- END: Page CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

<style>
    .tox-tinymce-aux .tox-notifications-container {
        display: none !important;
    }

    .tox-statusbar__branding {
        display: none;
    }

    @media print {
        .no-print ,
        .no-print * {
            display: none !important;
        }
        .print-only{
            display: block !important;
        }
    }

    @media screen {
        .print-only{
            display: none !important;
        }
    }

    .select2-selection__choice {
        word-wrap: break-word;
        white-space: break-spaces;
        word-break: break-word;
    }
    .table-responsive-md td, 
    .table-responsive-sm td {
        white-space: inherit;
        word-break: break-word;
    }

</style>
