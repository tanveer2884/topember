@extends('frontend.layouts.master')

@section('title', 'Register')
@section('description', 'Register new account here')


@section('page')

<div class="thank-you-wrapper" style="background-image:url('/images/thanks-banner.png');">
    <livewire:frontend.auth.register-controller />
</div>


@endsection


