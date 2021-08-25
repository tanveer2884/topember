@extends('frontend.layouts.master')

@section('title', '')
@section('description', '')

@section('page')

    <!-- heading  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-listing-head div-flex">
                        <h1 class="inner-heading">Our Products</h1>
                        <div class="product-filter-main category-filter justify-content-end">
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
                                <select id="sortby-input" class="form-control">
                                    <option value="is_featured">Featured</option>
                                    <option value="best_selling">Best Selling</option>
                                    <option value="az">Alphabetically A-Z</option>
                                    <option value="za">Alphabetically Z-A</option>
                                    <option value="expensive">Price High-Low</option>
                                    <option value="cheapest">Price Low-High</option>
                                    <option value="newest">Newest</option>
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
        <div class="product-bg category-wrapper-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="product-listing-main category-wrapper-left">
                            <h2 class="product-listing-main-sp">Filter</h2>
                            <h6 class="product-list-main-sp">Price</h6>
                            <div class="pro-price-filter">
                                <fieldset class="filter-price">

                                    <div class="price-field">
                                        <input type="range" min="1" max="{{$maxPrice}}" value="1" id="lower-val-input">
                                        <input type="range" min="1" max="{{$maxPrice}}" value="{{$maxPrice}}" id="upper-val-input">
                                    </div>
                                    <div class="price-wrap">
                                        <div class="price-wrap-1">
                                            <input id="one">
                                            <label for="one">$</label>
                                        </div>
                                        <div class="price-wrap-2">
                                            <input id="two">
                                            <label for="two">$</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            @foreach ($filters as $filter)
                                <div class="pro-checks-boxes filter-checkbox" data-filter-id="{{ $filter->id }}">
                                    <h6 class="product-list-main-sp">{{ $filter->name }}</h6>
                                    <div class="my-cart-check-box spec-border-bot">
                                        @foreach ($filter->values as $filterValue)
                                            <div>
                                                <div class="form-group ch-box-1">
                                                    <input type="checkbox" class="filter-value-checkbox" id="filter-{{ $filter->id }}{{ $filterValue->id }}" data-filter-id="{{ $filter->id }}" data-filter-value-id="{{ $filterValue->id }}">
                                                    <label for="filter-{{ $filter->id }}{{ $filterValue->id }}">{{ $filterValue->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="product-listing-main pr-0 category-main">
                            <h2>{{ $category->name }}</h2>
                            <!-- <a href="#" class="sp-view-all">View All</a> -->
                            <livewire:frontend.product.product-listing :category="$category" :baseUrl="$baseUrl" :categories="$categories" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="clearfix"></div>

    @include('frontend.layouts.instagram')

@endsection

@push('page_js')
    <script>
        let lowerSlider = document.querySelector("#lower-val-input");
        let upperSlider = document.querySelector("#upper-val-input");

        document.querySelector("#two").value = upperSlider.value;
        document.querySelector("#one").value = lowerSlider.value;

        var lowerVal = parseInt(lowerSlider.value),
            upperVal = parseInt(upperSlider.value);
        upperSlider.oninput = function() {
            lowerVal = parseInt(lowerSlider.value), (upperVal = parseInt(upperSlider.value)) < lowerVal + 4 && (lowerSlider.value = upperVal - 4, lowerVal == lowerSlider.min && (upperSlider.value = 4)), document.querySelector("#two").value = this.value
            firePriceChangeEvent();
        }

        lowerSlider.oninput = function() {
            lowerVal = parseInt(lowerSlider.value), 
            upperVal = parseInt(upperSlider.value), 
            lowerVal > upperVal - 4 && (upperSlider.value = lowerVal + 4, upperVal == upperSlider.max && (lowerSlider.value = parseInt(upperSlider.max) - 4)), 
            document.querySelector("#one").value = this.value
            firePriceChangeEvent()
        };

        let firePriceChangeEvent = debounce(function(){
                window.Livewire.emit('price-updated',[ lowerSlider.value, upperSlider.value ]);  
        },500)
        
        

        $('.filter-value-checkbox').on('change',function(){
            let selectedFilters = new Array;
            $('.filter-checkbox').each(function(){
                let filterValues = [];
                let filterId = $(this).data('filter-id');

                $(this).find('.filter-value-checkbox:checked').each(function(){
                    filterValues.push($(this).data('filter-value-id'))
                })

                if ( filterValues.length >0 ){
                    selectedFilters[filterId] = filterValues;
                }
            })

            selectedFilters = selectedFilters.filter(function(value,index){
                return typeof value != undefined;
            })

            window.Livewire.emit('filters-updated',selectedFilters)
        })

        $('#sortby-input').on('change',function(){
            window.Livewire.emit('updated-sortby',$(this).val())
        })
    </script>
@endpush
