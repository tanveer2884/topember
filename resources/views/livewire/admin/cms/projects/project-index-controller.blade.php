<x-slot name="pageTitle">
    {{ __('project.index.title') }}
</x-slot>

<div>
    <div class="mb-4 text-right">
        <x-admin.components.button tag="a" href="{{ route('admin.cms.projects.create') }}">
            {{ __('project.create.title') }}
        </x-admin.components.button>
    </div>

    <div class="border border-gray-300 shadow-gray-800 dark:shadow-gray-50 dark:border-gray-500 sm:rounded-lg">

        <div class="p-4 space-y-4">

            <div class="flex items-center space-x-4">
                <div class="grid w-full grid-cols-12 space-x-4">
                    <div class="col-span-8 md:col-span-8">
                        <x-admin.components.input.text wire:model.live="search"
                            placeholder="{{ __('project.index.search_placeholder') }}" />
                    </div>
                    <div class="col-span-4 text-right md:col-span-4">
                        <x-admin.components.input.checkbox-button wire:model.live="showTrashed" autocomplete="off">
                            {{ __('global.show_deleted') }}
                        </x-admin.components.input.checkbox-button>
                    </div>
                </div>
            </div>
        </div>

        <x-admin.components.table class="w-full p-2 whitespace-no-wrap">
            <x-slot name="head">
                <x-admin.components.table.heading>{{ __('global.title') }}</x-admin.components.table.heading>
                <x-admin.components.table.heading>{{ __('project.form.description') }}</x-admin.components.table.heading>
                <x-admin.components.table.heading>{{ __('global.image') }}</x-admin.components.table.heading>
                <x-admin.components.table.heading>{{ __('global.actions') }}</x-admin.components.table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($this->projects as $project)
                <x-admin.components.table.row wire:loading.class.delay="opacity-50">
                    <x-admin.components.table.cell>{{ $project->title }}</x-admin.components.table.cell>
                    <x-admin.components.table.cell>{!! $project->description !!}</x-admin.components.table.cell>
                    <x-admin.components.table.cell>
                        @if ($project->thumbnail)
                        <img class="w-12 rounded shadow" src="{{ $project->getThumbnailUrl() }}" loading="lazy" />
                        @else
                        <x-icon ref="photograph" class="w-8 h-8 mx-auto text-gray-300" />
                        @endif
                    </x-admin.components.table.cell>

                    <x-admin.components.table.cell>
                        @if (!$project->deleted_at)
                        <a href="{{ route('admin.cms.projects.show', $project->id) }}"
                            class="text-indigo-500 hover:underline">
                            {{ __('project.index.action.edit') }}
                        </a>
                        @else
                        <button class="text-indigo-500 hover:underline" wire:click="restore('{{ $project->id }}')">
                            {{ __('staff.index.action.restore') }}
                        </button> |
                        <x-confirmation-modal model="forceDelete('{{ $project->id }}')" />
                        @endif
                    </x-admin.components.table.cell>
                </x-admin.components.table.row>
                @endforeach
                @if($this->projects->isEmpty())
                <x-admin.components.table.no-results />
                @endif
            </x-slot>
        </x-admin.components.table>

        @if ($this->projects->hasPages())
        <div class="p-4 space-y-4">
            {{ $this->projects->links() }}
        </div>
        @endif
    </div>
</div>