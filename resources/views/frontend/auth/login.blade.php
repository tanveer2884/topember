@extends('frontend.layouts.master')


@section('title', 'Login')
@section('description', 'Login or Create new Account')

@section('page')

<div class="thank-you-wrapper" style="background-image:url('/images/thanks-banner.png');">
    <livewire:frontend.auth.login-controller :redirect="request('redirect')" />
</div>

@endsection
