<div class="featured-products div-flex">
    
    @foreach (getHomepageProducts() as $product)
    <a href="{{ route('product.index',$product->slug) }}" class="featured-prdt div-flex">
        <div class="featured-prdt-img div-flex">
            <img src="{{ $product->feature_image }}" alt="" class="img-fluid" />
        </div>
        <div class="featured-prdt-text">
            <h6>{{ $product->name }}</h6>
            <h4>
                {!! $product->short_description !!}
            </h4>
            <h3>${{ number_format($product->getPrice(),2) }}</h3>
        </div>
    </a>
    @endforeach
</div>
