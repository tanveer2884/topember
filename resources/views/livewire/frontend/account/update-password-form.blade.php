<div>

    <!-- Repeatable Row Starts -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="password" id="uoldpass" wire:model.defer="old_password" placeholder="Old Password" class="form-control" />
                    <label class="form-control-placeholder" for="uoldpass">
                        <span class="floating-text">Old Password</span>
                    </label>
                </div>
                @error('old_password')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="password" id="unewpass" wire:model.defer="new_password" placeholder="New Password" class="form-control" />
                    <label class="form-control-placeholder" for="unewpass">
                        <span class="floating-text">New Password</span>
                    </label>
                </div>
                @error('new_password')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <!-- Repeatable Row Ends -->

    <!-- Repeatable Row Starts -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="password" id="uconfirmpass" wire:model.defer="confirm_password" placeholder="Confirm Password" class="form-control" />
                    <label class="form-control-placeholder" for="uconfirmpass">
                        <span class="floating-text">Confirm Password</span>
                    </label>
                </div>
                @error('confirm_password')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="general-btn w-100 position-relative" wire:click="updatePassword">
                    Submit
                    @include('layouts.livewire.button-loading')
                </button>
            </div>
        </div>
    </div>

</div>
