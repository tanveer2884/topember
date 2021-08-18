@extends('frontend.layouts.master')

@section('title','Forgot Password')
@section('description','Reset Your password here')


@section('page')

<div class="thank-you-wrapper" style="background-image:url('/images/thanks-banner.png');">
    <livewire:frontend.auth.forgot-password-controller />
</div>

@endsection
