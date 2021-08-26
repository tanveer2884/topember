@extends('frontend.layouts.master')

@section('title', 'My Cart')
@section('description', '')

@section('page')
    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <div class="my-cart-main-wrapper">
                    <div class="my-cart-wrapper">
                        <div class="cart-first-container">
                            <div class="cart-main-heading div-float">
                                <h2 class="cart-main-head-style div-float">Your Cart</h2>
                                <div class="clearfix"></div>
                                <!-- table -->
                                <div class="wrapper-res-table table-responsive">
                                    <livewire:frontend.cart.cart-items-list />
                                </div>
                                <!-- check-box -->

                                <div class="my-cart-check-box">
                                    <form>
                                        <!-- <div class="form-group ch-box-1">
                                                <input type="checkbox" id="html">
                                                <label for="html">Do you need packing services?</label>
                                            </div> -->
                                        <div class="form-group ch-box-2">
                                            <input type="checkbox" id="css">
                                            <label for="css">Is this at Home?</label>
                                        </div>
                                        <div class="form-group ch-box-2">
                                            <input type="checkbox" id="javascript">
                                            <label for="javascript">Is this at Store?</label>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="cart-scnd-container">
                            <div class="cart-scnd-wrapper div-float">
                                <h2 class="order-summary-heading div-float">Order Summary</h2>
                                <div class="order-summary-price div-float">
                                    <p class="order-sum-price-1">Subtotal:</p>
                                    <p class="order-sum-price-2">$89.98</p>
                                    <p class="order-sum-price-1">Tax:</p>
                                    <p class="order-sum-price-2">$4.99</p>
                                    <p class="order-sum-price-1">Shipping:</p>
                                    <p class="order-sum-price-2">$0</p>
                                    <a href="javascript:void();" onclick="showDiscount()">Have a discount code?</a>
                                    <div class="for-discount-wrap d-none div-float mb-3" id="oneTwo">
                                        <form action="">
                                            <!-- <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append sp-apply-btn">
                                                        <button class="btn general-btn" type="button">Apply</button>
                                                    </div>
                                                </div> -->
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Discount Code">
                                                <div class="input-group-append">
                                                    <button class="btn general-btn imp-btn-new" type="submit">Apply</button>
                                                    <a href="javascript:void();" class="cross-up-discount" onclick="noDiscount()">x</a>
                                                </div>
                                            </div>
                                            <div class="error d-none">Fill the required field</div>
                                        </form>
                                    </div>
                                    <div class="hr hr-sp-class"></div>
                                    <p class="order-sum-price-7">Total</p>
                                    <p class="order-sum-price-8">$94.99</p>
                                    <div class="hr hr-sp-class"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="check-out-butn-wraper">
                                    <a href="my-cart-billing.php" class="check-out-butn general-btn">CHECKOUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section style="background-color: #F2F2F2; width:100%;">
        <div class="product-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-listing-main">
                            <h2>Recommended Products</h2>
                            <div class="product-list div-float">
                                @foreach (getFeaturedProducts() as $featuredProduct)
                                    <div class="product-card">
                                        <a href="{{ route('product.index',$featuredProduct->slug) }}" class="product-header div-flex">
                                            <img src="{{ $featuredProduct->feature_image }}" alt="" class="img-fluid">
                                        </a>
                                        <div class="product-body">
                                            <h3><a href="{{ route('product.index',$featuredProduct->slug) }}">{{ $featuredProduct->name }}</a></h3>
                                            <p> 
                                                {!! $featuredProduct->short_description !!}
                                            </p>
                                            <p>
                                                QTY: {{ $featuredProduct->qty }} <br>
                                                IN Stock: {{ $featuredProduct->isInStock() ? 'In Stock' : 'No' }} <br>
                                            </p>
                                            <div class="prdt-price d-flex">
                                                <h4>${{ number_format($featuredProduct->getPrice(),2) }}</h4>
                                                <livewire:frontend.cart.add-to-cart-button :product="$featuredProduct" :show-qty="false" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page_css')
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
@endpush

@push('page_js')
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script>
        $('.product-list').slick({
            infinite: true,
            arrows: false,
            dots: false,
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: true,

            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]

        });
    </script>
@endpush
