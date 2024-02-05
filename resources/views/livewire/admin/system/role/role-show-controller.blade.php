<x-slot name="pageTitle">
    {{ __('roles.edit.title') }}
</x-slot>
<form action="submit" method="POST" wire:submit.prevent="update">
    <div class="grid grid-cols-12">
        @include('livewire.admin.system.role.form')
    </div>
</form>
