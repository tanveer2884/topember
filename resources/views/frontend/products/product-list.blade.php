@extends('frontend.layouts.master')

@section('title', 'Our Products')
@section('description', 'Our Products')

@section('page')
<!-- heading  -->
<section>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="product-listing-head div-flex">
                <h1 class="inner-heading">Our Products</h1>
                <div class="product-filter-main category-page-one">
                    <div class="product-filter">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 10 12">
                                <g transform="translate(-5 -3)">
                                    <line y1="6" transform="translate(14 8)" fill="none" stroke="#909090" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                    <line y1="10" transform="translate(10 4)" fill="none" stroke="#909090" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                    <line y1="4" transform="translate(6 10)" fill="none" stroke="#909090" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </g>
                            </svg>
                            SORT BY:
                        </span>
                        <select name="" id="" class="form-control">
                            <option value="">Category</option>
                            <option value="">Newest</option>
                            <option value="">Low to High price</option>
                            <option value="">High to Low price</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- heading  -->

<div class="clearfix"></div>

<section style="background-color: #F2F2F2;">
@foreach ($categories as $category)
    <div class="product-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-listing-main">
                        <h2>{{ $category->name }}</h2>
                        <a href="{{ route('product.index', [$category->slug]) }}" class="sp-view-all">View All</a>
                        <div class="product-list div-float">

                            @foreach ($category->getTopProduct(4) as $product)
                                <div class="product-card">
                                    <a href="{{ route('product.index', implode('/',[$category->slug,$product->slug])) }}" class="product-header div-flex">
                                        <img src="{{ $product->feature_image }}" alt="" class="img-fluid" />
                                    </a>
                                    <div class="product-body">
                                        <h6>category Title</h6>
                                        <h3><a href="{{ route('product.index',implode('/',[$category->slug,$product->slug])) }}">{{ $product->name }}</a></h3>
                                        <p>{!! $product->short_description !!}</p>
                                        <div class="prdt-price d-flex">
                                            <h4>${{ number_format($product->getPrice(),2) }}</h4>
                                            <livewire:frontend.cart.add-to-cart-button :product="$product" :show-qty="false" />
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
@endforeach

</section>

<div class="clearfix"></div>

@include('frontend.layouts.instagram')
@endsection

@push('page_css')
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
@endpush

@push('page_js')
<script src="{{ asset('js/slick.min.js') }}"></script>
<script>
    $(".product-list").slick({
        infinite: !0,
        arrows: !1,
        dots: !1,
        autoplay: !0,
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: !0,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });
</script>
@endpush
