<form class="sort-orders div-flex">
   <select name="" id="" class="form-control" style="opacity: 0">
        <option value="">Search</option>
        <option value="">Search</option>
        <option value="">Search</option>
    </select>
    <input type="text" wire:model.defer="search" class="form-control"/>
    <button class="general-btn" wire:click="searchOrders">
        Search
        @include('layouts.livewire.button-loading')
    </button>
</form>
