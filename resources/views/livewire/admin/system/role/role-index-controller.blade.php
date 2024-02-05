<div>
    <div>
        {{-- Be like water. --}}
    </div>
    <x-slot name="pageTitle">
        {{ __('roles.index.title') }}
    </x-slot>
    
    <div>
        <div class="mb-4 text-right">
            <x-admin.components.button tag="a" href="{{ route('admin.system.role.create') }}">
                {{ __('roles.index.action.create') }}
            </x-admin.components.button>
        </div>
    
        <div class="overflow-hidden border border-gray-300 shadow-gray-800 dark:shadow-gray-50 dark:border-gray-500 sm:rounded-lg">
    
            <x-admin.components.table class="w-full p-2 whitespace-no-wrap">
                <x-slot name="head">
                    <x-admin.components.table.heading>{{ __('roles.name') }}</x-admin.components.table.heading>
                    <x-admin.components.table.heading></x-admin.components.table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($roles as $role)
                        <x-admin.components.table.row wire:loading.class.delay="opacity-50">
                            <x-admin.components.table.cell>{{ $role->name }}</x-admin.components.table.cell>
                            <x-admin.components.table.cell>
                                <a href="{{ route('admin.system.role.show', $role->id) }}" class="text-indigo-500 hover:underline">
                                    {{ __('roles.index.action.edit') }}
                                </a>
                            </x-admin.components.table.cell>
                        </x-admin.components.table.row>
                    @empty
                        <x-admin.components.table.no-results />
                    @endforelse
                </x-slot>
            </x-admin.components.table>
            <div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>    
</div>