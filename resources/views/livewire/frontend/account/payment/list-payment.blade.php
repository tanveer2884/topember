<div class="row position-relative">
    <div class="div-float add-sub-sec">
        <div class="row">
            @foreach($paymentProfiles as $profile)
            <div class="col-md-6">
                <livewire:frontend.account.payment.payment-block wire:key="{{ $this->getUniqueKey('component') }}" :profile="$profile" />
            </div>
            @endforeach
        </div>
    </div>
    {{-- @include('layouts.livewire.button-loading') --}}
</div>
