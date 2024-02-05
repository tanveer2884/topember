<div class="w-full mx-auto">

    <x-admin.components.card heading="{{ __('settings.settings.form.title') }}">
        <div class="grid grid-cols-2 gap-4">
            @foreach ($settings as $key => $value)
                @php($type = get_general_site_settings($key))

                @if ($type == 'hidden')
                    <div></div>
                @elseif ($type == 'heading')
                <div class="space-y-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __('inputs.' . $key) }}
                    </h3>
                </div>
                <div></div>
                @else
                    <x-admin.components.input.group label="{{ __('inputs.' . $key) }}" for="{{ $key }}"
                        :error="$errors->first('settings.' . $key)">
                        @if ($type == 'file')
                            <x-admin.components.input.fileupload wire:model="{{ 'settings.' . $key }}" :imagesHolder="'settings.' . $key"
                                :maxFiles="1" label="<span class='text-gray-400 plus'>+</span>" />

                            @if ($value)
                                <div class="relative flex-row flex-wrap p-2 border rounded feature-upload d-flex">
                                    <div class="bg-gray-200 rounded preview-img">
                                        <img class="img-fluid d-block mx-auto h-[150px]"
                                            src="{{ !is_string($value) ? $value->temporaryUrl() : $value }}"
                                            alt="">
                                    </div>
                                    <button wire:loading.attr="disabled"
                                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-gray-700 rounded-full cursor-pointer top-1 right-1 opacity-80"
                                        wire:click.prevent="$set('{{ 'settings.' . $key }}', '')">
                                        x
                                    </button>
                                </div>
                            @endif
                        @else
                            <x-admin.components.input.text type="{{ $type }}"
                                wire:model="settings.{{ $key }}" name="{{ $key }}"
                                id="{{ $key }}" :error="$errors->first('settings.' . $key)" />
                        @endif
                    </x-admin.components.input.group>
                @endif
            @endforeach
        </div>
    </x-admin.components.card>

    <div class="px-4 py-3 text-right rounded shadow bg-gray-50 sm:px-6">
        <button type="submit" wire:loading.attr="disabled"
            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('settings.settings.update.btn') }}
        </button>
    </div>

</div>
