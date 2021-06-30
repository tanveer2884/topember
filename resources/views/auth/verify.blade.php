@extends('layouts.app')

@section('content')
<div class="wrapper">

    <div class="card">

        <div class="card-body text-white">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-outline-white btn-block p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>

            <div class="form-group mt-4">
                <a class="btn btn-outline-white btn-block" href="{{ route('login') }}">
                    {{ __('Login Here') }}
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
