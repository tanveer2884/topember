<li class="item dd-item pl-2 {{ $item->children->isNotEmpty() ? 'pt-2' : 'py-2' }} my-1 items-center text-indigo-100 leading-none"
    data-id="{{ $item->id }}">
    <div class="p-4 bg-gray-100 rounded">
        <span class="inline mr-3 font-bold text-gray-700 uppercase cursor-move text-md dd-handle">
            <x-icon ref="menu" class="inline" />
        </span>
        <span
            class="flex-auto inline-block max-w-xs mx-3 overflow-hidden font-semibold text-left text-gray-500 whitespace-nowrap">{{ $item->title }}</span>
        <small class="inline-block max-w-xs overflow-hidden text-gray-400 whitespace-nowrap">
            {{ $item->link }}
        </small>
        <span class="float-right">
            <button wire:click.prevent="$dispatch('edit-item', { menuItem: {{ $item->id }} })"
                class="font-semibold leading-tight text-gray-500 rounded-full w-7 h-7 dark:bg-gray-500 dark:text-green-100">
                <x-icon ref="pencil-alt" class="text-xs" />
            </button>

            <button wire:click.prevent="$dispatch('delete-item', { menuItem: {{ $item->id }} })"
                class="text-xs font-semibold leading-tight text-gray-500 rounded-full w-7 h-7 dark:bg-gray-500 dark:text-green-100">
                <x-icon ref="x-circle" class="text-xs" />
            </button>
        </span>
    </div>

    @if ($item->children->isNotEmpty())
        <ol wire:ignore class="pt-2 nested-group dd-list">
            @foreach ($item->children as $child)
                @include('livewire.admin.cms.menu.builder-item', [
                    'item' => $child,
                ])
            @endforeach
        </ol>
    @endif
</li>
