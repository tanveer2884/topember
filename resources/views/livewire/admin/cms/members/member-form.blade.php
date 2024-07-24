<form action="submit" method="POST" wire:submit.prevent="save">
    <div class="grid grid-cols-12">
        <div class="col-span-12 space-y-4">
            <x-admin.components.card heading="">
                <header>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        @lang($memberTitle)
                    </h3>
                </header>
                <div class="grid grid-cols-2 gap-4">
                    <x-admin.components.input.group label="{{ __('inputs.title') }}" for="title" :error="$errors->first('member.title')">
                        <x-admin.components.input.text wire:model="member.title" name="title" id="title"
                            :error="$errors->first('member.title')" />
                    </x-admin.components.input.group>

                    <x-admin.components.input.group label="{{ __('member.form.designation') }}" for="designation"
                        :error="$errors->first('member.designation')">
                        <x-admin.components.input.text wire:model="member.designation" name="designation" id="designation"
                            :error="$errors->first('member.designation')" />
                    </x-admin.components.input.group>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-admin.components.input.group label="{{ __('member.form.inputs.linkedin') }}" for="linkedin" :error="$errors->first('member.linkedin')">
                        <x-admin.components.input.text wire:model="member.linkedin" name="linkedin" id="linkedin"
                            :error="$errors->first('member.linkedin')" />
                    </x-admin.components.input.group>

                    <x-admin.components.input.group label="{{ __('member.form.inputs.twitter') }}" for="twitter" :error="$errors->first('member.twitter')">
                        <x-admin.components.input.text wire:model="member.twitter" name="twitter" id="twitter"
                            :error="$errors->first('member.twitter')" />
                    </x-admin.components.input.group>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <x-admin.components.input.group label="{{ __('member.form.inputs.google') }}" for="google"
                        :error="$errors->first('member.google')">
                        <x-admin.components.input.text wire:model="member.google" name="google" id="google"
                            :error="$errors->first('member.google')" />
                    </x-admin.components.input.group>
                </div>
            </x-admin.components.card>

            <div id="images">
                <x-admin.components.image-manager :existing="$images" :maxFileSize="5"
                    :maxFiles="1" :multiple="false" model="imageUploadQueue" />
                @error('images')
                <div class="error">
                    <p class="text-sm text-red-600">{{ $message }}</p>
                </div>
                @enderror
            </div>

            <div class="px-4 py-3 text-right rounded shadow bg-gray-50 sm:px-6">
                <div class="flex flex-row justify-end gap-x-2">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span wire:loading.remove wire:loading.attr="disabled">
                            {{ __('global.save') }}
                        </span>
                    </button>
                </div>
            </div>

            @if ($member->exists && !$member->wasRecentlyCreated)
                <div class="bg-white border border-red-300 rounded shadow">
                    <header class="px-6 py-4 text-red-700 bg-white border-b border-red-300 rounded-t">
                        {{ __('inputs.danger_zone.title') }}
                    </header>
                    <div class="p-6 space-y-4 text-sm">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-6">
                                <strong>{{ __('member.form.danger_zone.label') }}</strong>
                                <p class="text-xs text-gray-600">{{ __('member.form.danger_zone.instructions') }}</p>
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
