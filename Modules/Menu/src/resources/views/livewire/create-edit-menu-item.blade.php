<div class="row">
    <div class="col-md-6 form-group">
        <label for="">
            Menu Item Title
        </label>
        <input type="text" class="form-control" placeholder="Enter Title" wire:model.defer="title">
        @error('title')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        <label for="">
            Menu Item Link
        </label>
        <input type="text" class="form-control" placeholder="Enter Link" wire:model.defer="link">
        @error('link')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-12 form-group">
        <button class="btn btn-primary position-relative" wire:click="save">
            Save
            @include('layouts.livewire.button-loading')
        </button>
    </div>
</div>
