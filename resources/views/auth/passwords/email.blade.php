@extends('layouts.app')

@section('content')
<div class="wrapper">

    <div class="card">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-outline-white btn-block">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>

                <div class="form-group mt-4">
                    <a class="btn btn-outline-white btn-block" href="{{ route('login') }}">
                        {{ __('Login Here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
