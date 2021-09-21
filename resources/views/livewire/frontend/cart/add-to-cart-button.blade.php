@if ($showQty)
<div class="product-cart-add">
    <div class="quantity-input-cont mt-0">
        <span class="input-number-decrement" wire:click="$emit('decreaseQty')">–</span>
        <input class="input-number" type="text" id="productQtybox{{$product->id}}"  wire:model.defer="qty" min="1" max="{{ $product->qty }}">
        <span class="input-number-increment" wire:click="$emit('increaseQty')">+</span>
    </div>
    <button type="btn" class="general-btn position-relative" wire:click="addToCart">
        Add to cart
        @include('layouts.livewire.button-loading')
    </button>
</div>

@push('page_js')
    <script>
        window.addEventListener('DOMContentLoaded',function(){

            @this.on('increaseQty',function(){
                let qtybox = '#productQtybox{{$product->id}}';
                if ( $(qtybox).val() < {{$product->qty}} ){
                    let newQty = parseInt($(qtybox).val()) + 1;
                    $(qtybox).val(newQty)
                    @this.set('qty', newQty,true)
                }
            })

            @this.on('decreaseQty',function(){

                let qtybox = '#productQtybox{{$product->id}}';
                if ( $(qtybox).val() > 1 ){
                    let newQty = parseInt($(qtybox).val()) - 1;
                    $(qtybox).val(newQty)
                    @this.set('qty', newQty,true)
                    return;
                }
                @this.set('qty', 1,true)
                $(qtybox).val(1)
            })
        })
    </script>
@endpush
@elseif($inSearchBar)
<a href="javascript:void(0);" id="product-{{$product->id}}" class="position-relative" wire:click="addToCart">Add to Cart &#8594;</a>
@else
<span class="position-relative" wire:click="addToCart">
    Add to Cart →
    @include('layouts.livewire.button-loading')
</span>
@endif
