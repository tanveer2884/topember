<div class="sign-in-wrapper">
    <div>
        <h2 class="pb-2">Reset Password</h2>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group d-none">
                        <input type="email" wire:model.defer="email" class="form-control forgot-sp-wide" placeholder="Your Email Address">
                        @error('email')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="password" wire:model.defer="password" class="form-control forgot-sp-wide" placeholder="Enter New Password">
                        @error('password')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="password" wire:model.defer="confirm_password" class="form-control forgot-sp-wide" placeholder="Confirm New Password">
                        @error('confirm_password')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="sign-in-side-butn">
                <button class="sign-in-butn general-btn position-relative" wire:click="resetPassword">
                    Reset Password
                    @include('layouts.livewire.button-loading')
                </button>
            </div>
        </div>
    </div>
</div>
