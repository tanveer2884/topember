@extends('layouts.app')

@section('content')
<div class="wrapper pt-3">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="text-white col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="text-white col-form-label text-md-right">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label text-white" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-block btn-outline-white bg-transparent">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="form-group mt-4">
                    @if (Route::has('password.request'))
                        <a class="d-inline-flex my-2 font-weight-bold text-white" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
{{--                         <span class="text-white px-2">--}}
{{--                            Or--}}
{{--                        </span>--}}
{{--                        <a class="d-inline-flex font-weight-bold text-white" href="{{ route('register') }}">--}}
{{--                            {{ __('Register') }}--}}
{{--                        </a>--}}
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
