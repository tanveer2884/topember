<div class="cart-scnd-wrapper div-float">
    <h2 class="order-summary-heading div-float">
        Sign In<br>(Optional)
    </h2>
    <div class="sign-up-right-side div-float">
        <div class="sign-up-side-form">
            <div>
                <div class="row">
            
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="email" class="form-control" wire:model.defer="username" placeholder="E-mail">
                            @error('username')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="password" class="form-control" wire:model.defer="password" placeholder="Password">
                            @error('password')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
            
                </div>
                <div class="forgot-password div-float">
                    <a href="{{ route('user.forgot-password') }}" class="forgot-pass div-float">Forgot Password?</a>
                </div>
                <div class="clearfix"></div>
                <div class="sign-in-side-butn sp-bott-set">
                    <button wire:click="login" class="sign-in-butn general-btn position-relative">
                        LOGIN
                        @include('layouts.livewire.button-loading')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
