<div class="sign-in-wrapper">
    <h2>Sign In</h2>
    <a class="dnt-have-pass" href="{{ route('user.register') }}">Don’t have an account?</a>

    <div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" id="uname" wire:model.defer="username" placeholder="E-mail" class="form-control" autofocus autocomplete="off" />
                    @error('username')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <input type="password" id="upassword" wire:model.defer="password" placeholder="Password" class="form-control" autocomplete="off" />
                    @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <a class="forgot-pass" href="{{ route('user.forgot-password') }}">Forgot Password?</a>
        <div class="sign-in-side-butn">
            <button wire:click="login" class="sign-in-butn general-btn position-relative">
                LOGIN
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </div>
</div>