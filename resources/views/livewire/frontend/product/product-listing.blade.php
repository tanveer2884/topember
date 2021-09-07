<div class="position-relative">
    <div class="product-list div-flex ">
        @foreach ($products as $product)
            <div class="product-card product-card-wide">
                <a href="{{ route('product.index', implode('/', [$category->slug, $product->slug])) }}" class="product-header div-flex">
                    <img src="{{ $product->feature_image }}" alt="" class="img-fluid" />
                </a>
                <div class="product-body">
                    <h6>{{ $category->name }}</h6>
                    <h3><a href="{{ route('product.index', implode('/', [$category->slug, $product->slug])) }}">{{ $product->name }}</a>
                    </h3>
                    <p>
                        {!! $product->short_description !!}
                    </p>
                    <div class="prdt-price d-flex">
                        @if ( $product->hasSpecialPrice() )
                            <div>
                                <h4 class="mb-0">${{ number_format($product->getPrice(),2) }}</h4>
                                <small style="font-size: 13px;"><strike>${{ number_format($product->price,2) }}</strike></small>
                            </div>
                        @else
                            <h4>${{ number_format($product->getPrice(),2) }}</h4>
                        @endif
                        <livewire:frontend.cart.add-to-cart-button :product="$product" :showQty="false" :inSearchBar="false" />
                    </div>
                </div>
            </div>
        @endforeach

        @if ($products->hasMorePages())
            <div class="check-out-butn-wraper sp-padding-bottom-end">
                <a href="#" class="check-out-butn general-btn">Load more</a>
            </div>
        @endif
    </div>
    @include('layouts.livewire.loading')
</div>
