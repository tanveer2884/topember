@extends('frontend.layouts.master')

@section('title','Reset Password')
@section('description','Reset new Password here')

@section('page')

<div class="thank-you-wrapper" style="background-image:url('/images/thanks-banner.png');">
    <livewire:frontend.auth.reset-password-controller :token="$token"/>
</div>

@endsection