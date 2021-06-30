@extends('layouts.app')

@section('content')
<div class="wrapper">

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-outline-white btn-block">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="form-group mt-2">
                    <span class="text-white">Already Registered ? </span>
                    <a class="d-inline-flex mx-2 font-weight-bold text-white" href="{{ route('login') }}">
                        {{ __('Login Here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
