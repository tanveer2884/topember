<div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="password" wire:model.defer="old_password" class="form-control" placeholder="Old Password" />
                @error('old_password')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="password" wire:model.defer="new_password" class="form-control" placeholder="New Password" />
                @error('new_password')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="password" wire:model.defer="confirm_password" class="form-control" placeholder="Confirm Password" />
                @error('confirm_password')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="general-btn mt-2" wire:click="updatePassword">
                Submit
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </div>

</div>
