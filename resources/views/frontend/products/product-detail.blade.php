@extends('frontend.layouts.master')

@section('title', '')
@section('description', '')

@section('page')
    <!-- breadcrumb -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="prdt-breadcrumb">
                        <ul>
                            @foreach ($categories as $categoryNav)
                            <li>
                                <li>></li>
                                <a href="{{ route('product.index',$categoryNav->slug) }}">{{ strtoupper($categoryNav->name) }}</a>
                            </li>
                            @endforeach
                            <li>></li>
                            <li>{{ $product->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb -->

    <div class="clearfix"></div>

    <!-- product Detail -->
    <section class="product-detail-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-detail-main div-float">
                        <div class="product-detail-img">
                            <div class="slider-for">
                                <img src="{{ $product->feature_image }}" class="img-fluid" alt="" />
                                @foreach ($product->getImages() as $image)
                                    <img src="{{ route('api.medias.show', $image) }}" class="img-fluid" alt="" />
                                @endforeach
                            </div>
                            <div class="slider-nav">
                                <img src="{{ $product->feature_image }}" class="img-fluid" alt="" />
                                @foreach ($product->getImages() as $image)
                                    <img src="{{ route('api.medias.show', $image) }}" class="img-fluid" alt="" />
                                @endforeach
                            </div>
                        </div>
                        <div class="product-detail-text">
                            <h3>{{ optional($category)->name }}</h3>
                            <h1>{{ $product->name }}</h1>
                            <h5>Item Number: {{ $product->model_number }}</h5>
                            <h4 class="color-blue">${{ number_format($product->getPrice()) }}</h4>
                            <div class="manufacturer">
                                <h6>Manufacturer:</h6>
                                <img src="/images/product-detail.png" alt="Manufacturer">
                            </div>
                            <p>
                                {!! $product->short_description !!}
                            </p>
                            <div class="product-cart-add">
                                <div class="quantity-input-cont mt-0">
                                    <span class="input-number-decrement">–</span>
                                    <input class="input-number" type="text" value="1" min="1" max="100">
                                    <span class="input-number-increment">+</span>
                                </div>
                                <a href="my-cart.php" type="btn" class="general-btn">Add to cart</a>
                            </div>

                            <div class="select-delivery">
                                <span>Delivery or Store Pickup:</span>
                                <select name="" id="" class="form-control red-select">
                                    <option value="">Select</option>
                                    <option value="">Delivery</option>
                                    <option value="">Store Pickup</option>
                                </select>
                            </div>
                            <div class="share-icons-div">
                                <span>Share:</span>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="20" viewBox="0 0 11 23">
                                        <image width="10" height="20" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAXCAYAAADduLXGAAAA3UlEQVQ4je2TPYoCQRCFP0dNFsFEDEWEBTHY0MAbeAID2Vy8yaQmXkDB1FivYLIYaCAiCP6wmggmAyoNPVA+ZoLNt6Bp6tXX1a/p7kwYhkj0gW+g5uU7cAZ+cgIOgZ6uBqrAV2CEVgoYx9x2bicAa2AJlIGZhUsCboC6FayNrMA73cbCF6k9FXY2On5uSq0CdE2+ctBEO/j4BEYmHwQpYFJsHXwFIuCR4DkyY+/ghvc3Fnjh9XhMneeTL/4K7N7E0QrW84fAefX9lwP+w6lwQWpFhe1PcTd4M/nhjQReDe4ktJ+5u04AAAAASUVORK5CYII="></image>
                                    </svg>
                                </a>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="19" viewBox="0 0 22 18">
                                        <image width="23" height="19" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAASCAYAAABfJS4tAAABh0lEQVQ4jaXUP0iWURTH8Y+iRSIWDUFBSENIf7aaGhqkoRLCgppaGlpcg6CExuhd3NrEpqaWJBEcGhoyh6BoiKJaQrRA0GrJoowDR3h4eB/uq/3g8tx7zz3fc+9zz7ldrVbLFrUXdzCCAXzEA0ym/SzWetCHhxjH2wJ0H15jf23uVAbqxYHod2MQo5jHsQL4UQ1a1WjCn2E4wLvSuBtvMNbgeBinC4HXcRUr3Xn89TTE+D5e4loGqzqV9APHMRf/+CcuYrbidAJTmMCLDBRB/+a3SYv4GrYAH8EfzOB8zXEPzmULbRR2/Guz05O7mMMyugqOJfu7zU7s7j2e5G2XHEuar4LlTb76T2houg7+nv8xLmt1m9DH+FIHh4ZwCTu3Cb5ZHVTBkVafssS3qnv40AT+jTO4gadY6hAeJXyrPtku2SeyrFc6gEYWDLczRB4fwo5MtaO4gCuVN6RJ8UxebzIGOJ6521l1neg57taegLbgWHg5jxTtJA6iP9d8w+e83CikhWJ0/AMDX0c4GPaTYQAAAABJRU5ErkJggg=="></image>
                                    </svg>
                                </a>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.719" height="20" viewBox="0 0 15.719 20">
                                        <g id="XMLID_798_" transform="translate(-33.181)">
                                            <path id="XMLID_799_" d="M46.862,2.049A7.67,7.67,0,0,0,41.5,0a8.433,8.433,0,0,0-6.219,2.4,7.086,7.086,0,0,0-2.1,4.911c0,2.226.931,3.935,2.491,4.571a.825.825,0,0,0,.313.065.7.7,0,0,0,.68-.561c.053-.2.175-.687.228-.9a.843.843,0,0,0-.226-.912,2.907,2.907,0,0,1-.661-1.986,5,5,0,0,1,5.183-5.032c2.671,0,4.331,1.518,4.331,3.962a8.233,8.233,0,0,1-.936,4.022,2.767,2.767,0,0,1-2.288,1.6,1.517,1.517,0,0,1-1.207-.552,1.388,1.388,0,0,1-.243-1.206c.119-.5.281-1.03.439-1.538a9.519,9.519,0,0,0,.558-2.5,1.818,1.818,0,0,0-1.83-2c-1.391,0-2.481,1.413-2.481,3.217a4.784,4.784,0,0,0,.342,1.8c-.175.743-1.217,5.157-1.414,5.99-.114.486-.8,4.324.337,4.63,1.28.344,2.424-3.394,2.54-3.817.094-.344.425-1.643.627-2.441a3.869,3.869,0,0,0,2.581,1A5.756,5.756,0,0,0,47.163,12.4,9.282,9.282,0,0,0,48.9,6.73,6.544,6.544,0,0,0,46.862,2.049Z" transform="translate(0 0)" fill="#898989" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="product-description-main">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="additional-info">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product Detail -->

    <div class="clearfix"></div>

    <section style="background-color: #F2F2F2;">
        <div class="product-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-listing-main">
                            <h2>Related Products</h2>
                            <div class="product-list div-float">

                                @foreach ($product->getRelatedProducts() as $relatedProduct)
                                    <div class="product-card">
                                        <a href="{{ route('product.index',"{$category->slug}/{$product->slug}") }}" class="product-header div-flex">
                                            <img src="{{ $relatedProduct->feature_image }}" alt="" class="img-fluid" />
                                        </a>
                                        <div class="product-body">
                                            <h3><a href="{{ route('product.index',"{$category->slug}/{$product->slug}") }}">{{ $relatedProduct->name }}</a></h3>
                                            {!! $relatedProduct->short_description !!}
                                            <div class="prdt-price d-flex">
                                                <h4>${{ number_format($relatedProduct->getPrice()) }}</h4>
                                                <span>Add to Cart →</span>
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
    $('.slider-for').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       adaptiveHeight: true,
       asNavFor: '.slider-nav'
   });
   $('.slider-nav').slick({
       slidesToShow: 5,
       slidesToScroll: 1,
       asNavFor: '.slider-for',
       dots: false,
       centerMode: true,
       focusOnSelect: true,
       arrows: false,

       responsive: [ 
           {
           breakpoint: 1200,
               settings: {
                   slidesToShow: 4,
                   slidesToScroll: 1
               }
           },
           {
           breakpoint: 992,
               settings: {
                   slidesToShow: 3,
                   slidesToScroll: 1
               }
           },
           {
           breakpoint: 700,
               settings: {
                   slidesToShow: 2,
                   slidesToScroll: 1
               }
           },
           {
           breakpoint: 576,
               settings: {
                   slidesToShow: 4,
                   slidesToScroll: 1
               }
           },
           {
           breakpoint: 400,
               settings: {
                   slidesToShow: 3,
                   slidesToScroll: 1
               }
           }
       ]
   });

   $('.product-list').slick({
       infinite: true,
       arrows: false,
       dots: false,
       autoplay: true,
       slidesToShow: 4,
       slidesToScroll: 1,   
       adaptiveHeight: true,

       responsive: [ 
           {
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