<div class="{{ $sidebar ? 'order-summary-price' :'pay-oder-detail-wrap' }} div-float position-relative">

    <div class="{{ $sidebar ? '' :'pay-oder-detail-left' }}">
        <p class="{{ !$sidebar?'order-pay-1':'order-sum-price-1' }} ">Subtotal:</p>
        <p class="{{ !$sidebar?'order-pay-2':'order-sum-price-2' }} ">${{ number_format($subTotal,2) }}</p>
        @if ($tax)
        <p class="{{ !$sidebar?'order-pay-1':'order-sum-price-1' }}">Tax:</p>
        <p class="{{ !$sidebar?'order-pay-2':'order-sum-price-2' }} ">${{ number_format($tax,2) }}</p>
        @endif
        @if ($shipping)
        <p class="{{ !$sidebar?'order-pay-1':'order-sum-price-1' }}">Shipping:</p>
        <p class="{{ !$sidebar?'order-pay-2':'order-sum-price-2' }} ">${{ number_format($shipping,2) }}</p>
        @endif
        @if ($discount)
        <p class="{{ !$sidebar?'order-pay-1':'order-sum-price-1' }}">Discount:</p>
        <p class="{{ !$sidebar?'order-pay-2':'order-sum-price-2' }} ">${{ number_format($discount,2) }}</p>
        @endif
    
        <a href="javascript:void(0);" class="{{ !$sidebar ? 'float-right' :'' }}" wire:click="$emit('toggleCoupon')">Have a discount code?</a>
        <div class="for-discount-wrap {{ $isCouponApplied ? '' : 'd-none' }} div-float mb-4" wire:ignore id="oneTwo">
            <livewire:frontend.cart.coupon-code />
        </div>
    
        <div class="{{ $sidebar ? 'hr hr-sp-class' : 'hr hr-sp-pay' }}"></div>
        <p class="{{ !$sidebar?'order-pay-7':'order-sum-price-7' }}">Total</p>
        <p class="{{ !$sidebar?'order-pay-8':'order-sum-price-8' }}">${{ number_format($total,2) }}</p>
        <div class="{{ $sidebar ? 'hr hr-sp-class' : 'hr hr-sp-pay' }}"></div>
    </div>
    @include('layouts.livewire.button-loading')
</div>

@push('page_js')
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            window.Livewire.on('toggleCoupon',function(){
                if ( $('#oneTwo').hasClass('d-none') ){
                    $('#oneTwo').removeClass('d-none')
                }else{
                    $('#oneTwo').addClass('d-none')
                }
            })
        })
    </script>
@endpush