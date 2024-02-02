<x-slot name="pageTitle">
    {{ __('profile.edit.heading') }}
</x-slot>
<form action="submit" method="POST" wire:submit.prevent="update">
    <div class="flex flex-col">
        @include('livewire.admin.profile.profile-form')
    </div>
</form>
