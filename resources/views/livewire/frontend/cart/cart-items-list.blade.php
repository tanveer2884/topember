<table class="table table-wrapper">
    <thead>
        <tr>
            <th scope="col">Item</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $cartProduct)
            <livewire:frontend.cart.cart-item :key="$this->getUniqueKey('cart-item')" :cart-product="$cartProduct" />                                        
        @endforeach
    </tbody>
</table>


@push('page_js')
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            window.Livewire.on('removeItem',function(id){
                @this.emit('delete-item',id)
            });

            window.Livewire.on('reload-page',function(){
                window.location.reload();
            })
        })
    </script>
@endpush