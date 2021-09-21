<div class="search-main-wrapper">
    <div class="search-arrow-set"></div>
    <input type="search" class="form-control" wire:model.debounce.700ms="search" id="exampleFormControlInput1" placeholder="Search Product by Sku, name, description, model number etc.">
    <div class="serach-over-flow-wrap">
        <div wire:loading.remove>
            @if ($isSearched)
                @forelse ($products as $product)
                    <div>
                        @if ($loop->index != 0)
                            <div class="hr search-sp-hr"></div>
                        @endif
                        <div class="search-container">
                            <div class="srch-pic-holder" style="background-image:url('{{ $product->feature_image }}');"></div>
                            <div class="search-data-cont">
                                <h3>
                                    <a href="{{ route('product.index',$product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p>
                                    {!! $product->short_description !!}
                                </p>

                                <livewire:frontend.cart.add-to-cart-button :key="$product->id" :inSearchBar="true" :product="$product" :showQty="false" />
                            </div>
                            <div class="search-data-price">
                                <h4>${{ number_format($product->getPrice(), 2) }}</h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        No result found.
                    </div>
                @endforelse
            @else
                <div class="text-center">
                    Type to search...
                </div>
            @endif
        </div>
        <div wire:loading class="w-100">
            <div class="text-center">
                Loading...
            </div>
        </div>
    </div>
</div>
