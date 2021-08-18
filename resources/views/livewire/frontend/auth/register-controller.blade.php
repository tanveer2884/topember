<div class="sign-in-wrapper register-sp-wrap">
    <h2 class="register-heading">Register</h2>

    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group register-sp-padding">
                    <input type="text" wire:model.defer="first_name" class="form-control" placeholder="First Name">
                    @error('first_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group register-sp-padding">
                    <input type="text" wire:model.defer="last_name" class="form-control" placeholder="Last Name">
                    @error('last_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group register-sp-padding">
                    <input type="email" wire:model.defer="email" class="form-control" placeholder="E-Mail Address">
                    @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group register-sp-padding">
                    <input type="password" wire:model.defer="password" class="form-control" placeholder="Password">
                    @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group register-sp-padding">
                    <input type="password" wire:model.defer="confirmPassword" class="form-control" placeholder="Confirm Passowrd">
                    @error('confirmPassword')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="sign-in-side-butn">
            <button class="sign-in-butn general-btn position-relative"  wire:click="register">
                Register
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </div>
</div>