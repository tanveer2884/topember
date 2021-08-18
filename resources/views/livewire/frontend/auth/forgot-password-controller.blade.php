<div class="sign-in-wrapper">
    <h2>Forgot Your Password?</h2>
    <p>
        Don’t worry! Just fill in your email and we'll send
        you a link to reset your password.
    </p>

    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="email" wire:model.defer="email" class="form-control forgot-sp-wide" id="exampleFormControlInput1" placeholder="Your Email Address">
                    @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="sign-in-side-butn">
            <button class="sign-in-butn general-btn position-relative" wire:click="sendPasswordResetLink">
                Reset Password
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </div>
</div>
