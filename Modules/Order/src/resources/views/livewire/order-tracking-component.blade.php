<div class="editOnFocus position-relative">
    <div class="d-flex">
        <p title="Click to Add tracking number" class="w-100">
            @if($tracking)
            {{$tracking}}
            @else
            Click to Add Tracking
            @endif
        </p>
        <div class="input" style="display: none;">
            <input type="text" wire:model.defer="tracking" class="form-control">
            <button class="btn btn-sm btn-success" wire:click="submit">
                <i class="fa fa-check"></i>
            </button>

            <button class="btn btn-sm btn-danger cancel-edit">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    @include('layouts.livewire.button-loading')
</div>