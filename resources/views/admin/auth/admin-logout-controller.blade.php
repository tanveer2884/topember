<div class="w-full">
    <form wire:submit.prevent="logout">
        <button id="sidebar-button" wire:loading.remove wire:target="logout" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
            Logout
        </button>
        <i class="text-xl leading-none las la-circle-notch la-spin" wire:loading wire:target="logout"></i>
    </form>
</div>