<form action="submit" method="POST" wire:submit.prevent="save">
    <div class="grid grid-cols-12">
        <div class="col-span-12 space-y-4">
            <x-admin.components.card heading="">
                <header>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        @lang($projectTitle)
                    </h3>
                </header>
                <div class="grid grid-cols-2 gap-4">
                    <x-admin.components.input.group label="{{ __('inputs.title') }}" for="title"
                        :error="$errors->first('project.title')">
                        <x-admin.components.input.text wire:model="project.title" name="title" id="title"
                            :error="$errors->first('project.title')" />
                    </x-admin.components.input.group>

                    <x-admin.components.input.group label="{{ __('project.form.link') }}" for="link"
                        :error="$errors->first('project.link')">
                        <x-admin.components.input.text wire:model="project.link" name="link"
                            id="link" :error="$errors->first('project.link')" />
                    </x-admin.components.input.group>
                </div>
                <div>
                        <label class="flex items-center text-sm font-medium text-gray-700" for="description">
                            <span class="block"></span>
                            <span class="block">Description</span>
                        </label>
                        <div class="relative mt-1">
                            <x-admin.components.input.richtext wire:model.defer="project.description" :initialValue="$project->description" />
                        </div>
                        @error('project.description')
                        <div class="space-y-1 text-center">
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                
            </x-admin.components.card>

            <div id="images">
                <x-admin.components.image-manager :existing="$images" :filetypes="$filetypes" :maxFileSize="$maxFileSize"
                    :maxFiles="$maxFiles" :multiple="false" model="imageUploadQueue" />
                @error('images')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-4 py-3 text-right rounded shadow bg-gray-50 sm:px-6">
                <div class="flex flex-row justify-end gap-x-2">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span wire:loading.attr="disabled">
                            {{ __('global.save') }}
                        </span>
                    </button>
                </div>
            </div>

            @if ($project->exists && !$project->wasRecentlyCreated)
            <div class="bg-white border border-red-300 rounded shadow">
                <header class="px-6 py-4 text-red-700 bg-white border-b border-red-300 rounded-t">
                    {{ __('inputs.danger_zone.title') }}
                </header>
                <div class="p-6 space-y-4 text-sm">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6">
                            <strong>{{ __('project.form.danger_zone.label') }}</strong>
                            <p class="text-xs text-gray-600">{{ __('project.form.danger_zone.instructions') }}</p>
                        </div>
                        <div class="col-span-9 lg:col-span-4">
                            <x-admin.components.input.text wire:model.live="deleteConfirm" />
                        </div>
                        <div class="col-span-3 text-right lg:col-span-2">
                            <x-admin.components.button theme="danger" :disabled="!$this->canDelete" wire:click="delete"
                                type="button">{{ __('global.delete') }}</x-admin.components.button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</form>