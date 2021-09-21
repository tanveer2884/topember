<div class="div-float add-box-wrap position-relative">

    <div class="div-float addbox-hdr">
        <img src="{{ asset('/images/card-' . Str::title($profile->card_type) . '.png') }}"
            alt="{{ $profile->card_type }}" class="img-responsive" />
        <div class="add-right-links">
            <label class="cc-chekcout" wire:click.prevent="toggleDefault('{{ $profile->id }}')">
                <input id="bill-chk" value="defaultShipping" type="checkbox"
                    {{ $profile->isDefault() ? 'checked="checked"' : '' }}>
                <span class="cc-chekmark"></span>
            </label>
        </div>
    </div>

    <div class="div-float addbox-content">
        <p>Card Number **********{{ $profile->card_last }}</p>
        <p>Expiry Date : {{ $profile->expiry }}</p>
        <p>&nbsp;</p>
        <p>
            <a href="javascript:void(0);" wire:click="$emit('confirmDelete','{{ $profile->id }}')" title="Delete">
                <i class="far fa-trash-alt"></i>
            </a>
        </p>
    </div>

    @include('layouts.livewire.button-loading')
</div>
