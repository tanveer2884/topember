<div>
    <div>
        <div class="form-inline last-reset reseting-form">
            <label for="email">E-Mail Adress </label>
            <input type="email" readonly wire:model.defer="email" name="email">
        </div>
        @error('email')
        <div class="error-class">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="clearfix"></div>

    <div>
        <div class="form-inline last-reset reseting-form">
            <label for="password">New Password </label>
            <input type="password" wire:model.defer="password" name="email">
        </div>
        @error('password')
        <div class="error-class">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="clearfix"></div>

    <div>
        <div class="form-inline last-reset reseting-form">
            <label for="confirm_password">New Password </label>
            <input type="password" id="confirm_password" wire:model.defer="confirm_password" name="email">
        </div>
        @error('confirm_password')
        <div class="error-class">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="clearfix"></div>

    <div>
        <button type="submit" wire:click="resetPassword" class="btn reset-button position-relative">
            Reset
            @include('layouts.livewire.button-loading')
        </button>
    </div>
</div>
