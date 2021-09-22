@extends('layouts.app')

@section('title','404 Page not Found')
@section('description','Sorry The page you are looking cannot be found on this server')

@section('page')

<div class="error-main-wrapper" style="background-image:url('/images/error-banner.png');">
    <div class="error-sp-wrap">
        <div class="error-top-wrap">
            <h1>4</h1>
            <img src="/images/sad-face.png" alt="sad-face">
            <h1>4</h1>
        </div>
        <h4 class="text-uppercase mb-3">Page Not Found</h4>
        <p>
            The page you are looking for might have been removed, 
            had it’s name changed or is temporarily unavailable.
        </p>
        <div class="sign-in-side-butn">
            <a href="javascript:history.back();" class="sign-in-butn general-btn">Go Back</a>
        </div>
    </div>
    <div class="error-sp-wrap-2"></div>
    <div class="error-sp-wrap-3"></div>
</div>

@endsection