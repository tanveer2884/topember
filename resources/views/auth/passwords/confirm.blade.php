@extends('layouts.app')

@section('content')
<div class="wrapper">

    <div class="card">

        <div class="card-body">
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group">
                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-outline-white btn-block">
                        {{ __('Confirm Password') }}
                    </button>
                </div>

                <div class="form-group mt-3">
                    <span class="text-white">Go to Login </span>
                    <a class="d-inline-flex mx-2 font-weight-bold text-white" href="{{ route('login') }}">
                        {{ __('Login Here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
