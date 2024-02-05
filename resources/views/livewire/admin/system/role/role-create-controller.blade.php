<x-slot name="pageTitle">
    {{ __('roles.create.title') }}
</x-slot>
<form action="submit" method="POST" wire:submit.prevent="create">
    <div class="grid grid-cols-12">
        @include('livewire.admin.system.role.form')
    </div>
</form>
