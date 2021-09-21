<div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" wire:model.defer="first_name" placeholder="First Name" class="form-control" />
                </div>
                @error('first_name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" wire:model.defer="last_name" placeholder="Last Name" class="form-control" />
                </div>
                @error('last_name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="floating-labels">
                    <input readonly disabled type="email" wire:model.defer="email" placeholder="Email" class="form-control" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="general-btn mt-2" wire:click="register">
                Submit
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </div>


</div>
