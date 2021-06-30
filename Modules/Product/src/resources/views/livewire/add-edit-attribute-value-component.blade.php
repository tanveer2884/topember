<div>
    <hr>
    <div class="row align-items-end">
        <div class="col-md-8">
            <label for="">Attribute Value Name</label>
            <input type="text" class="form-control" wire:model.defer="name">
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary" wire:click="submit">Save</button>
            <button class="btn btn-warning" wire:click="cancel">Cancel</button>
        </div>
    </div>

    @include('layouts.livewire.loading')
</div>