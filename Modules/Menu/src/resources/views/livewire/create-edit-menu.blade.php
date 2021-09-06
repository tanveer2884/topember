<div class="row justify-content-center">
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Enter Menu Name" wire:model.defer="name">
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary position-relative" wire:click="save">
            Save
            @include('layouts.livewire.button-loading')
        </button>
    </div>
</div>