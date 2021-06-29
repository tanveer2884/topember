<div>
    <div class="position-relative overflow-hidden">
        @if ($model->isActive())
            <button class="btn btn-sm btn-success w-100" wire:click="markDisable()">
                <i class="fa fa-check"></i>
                Active
            </button>
        @else
            <button class="btn btn-sm btn-danger w-100" wire:click="markActive()">
                <i class="fa fa-times"></i>
                Disabled
            </button>
        @endif
        @include('layouts.livewire.button-loading')
    </div>
</div>
