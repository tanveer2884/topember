<div>
    <div class="form-inline reseting-form">
        <label for="email">E-Mail Adress </label>
        <input type="email" wire:model.defer="email" name="email">
    </div>
    @error('email')
    <div class="error-class" style="float:right; width: 234px; text-align: left;margin-bottom:1rem;">
        {{ $message }}
    </div>
    @enderror
   
    <div class="clearfix"></div>

    <div>
        <button type="submit" wire:click="sendPasswordResetLink" class="btn reset-button position-relative">
            SEND PASSWORD RESET LINK
            @include('layouts.livewire.button-loading')
        </button>
    </div>
</div>
