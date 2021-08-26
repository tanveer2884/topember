<tr>
    <td>
        <img src="{{ $cartProduct->associatedModel->feature_image }}" alt="product image">
        <a href="{{ route('product.index',$cartProduct->associatedModel->slug) }}">
            <p>{{ $cartProduct->associatedModel->name }}</p>
        </a>
    </td>
    <td>
        <p>${{ number_format($cartProduct->associatedModel->getPrice(),2) }}</p>
    </td>
    <td>
        <div class="quantity-input-cont">
            <span class="input-number-decrement">–</span>
            <input class="input-number" type="text" value="{{ $cartProduct->quantity }}" min="1" max="100">
            <span class="input-number-increment">+</span>
        </div>
    </td>
    <td>
        <p class="cart-rate">${{ number_format($cartProduct->getPriceSum(),2) }}</p>
        <a href="javascript:void(0);" class="cart-cross position-relative" wire:click="$emit('removeItem','{{ $cartProduct->id }}')">
            x
            @include('layouts.livewire.button-loading')
        </a>
    </td>
</tr>
