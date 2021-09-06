@extends('frontend.layouts.master')

@section('title', 'Confirm Order')
@section('description', 'Confirm Order')

@section('page')

    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <div class="my-cart-main-wrapper">
                    <div class="my-cart-wrapper for-center-div">
                        <div class="cart-first-container">
                            <div class="cart-main-heading div-float sp-under-bor">
                                <h2 class="cart-main-head-style div-float">CHECKOUT</h2>
                            </div>
                            <div class="order-confirm-heading div-float">
                                <h2 class="shipping-main-head-style div-float">Order Confirmation</h2>
                            </div>
                            <div class="clearfix"></div>
                            <!-- order-deatil -->

                            <div class="order-detail-wrapper div-float">
                                <div class="order-detail div-float">
                                    <div class="payment-method-wrapper">
                                        <div class="shipping-adress-details">
                                            <h3 class="adress-details-head">Shipping{{ $is_shipping_billing_same ? '/Billing' :'' }} Address</h3>
                                            <p class="adress-details-para">{{ optional($shipping)['first_name'] }} {{ optional($shipping)['last_name'] }}</p>
                                            <p class="adress-details-para">{{ optional($shipping)['address'] }}, {{ optional($shipping)['state'] }}</p>
                                            <p class="adress-details-para">{{ optional($shipping)['city'] }} {{ optional($shipping)['zip_code'] }}</p>
                                            <p class="adress-details-para">United States</p>
                                            <p class="adress-details-para">{{ optional($shipping)['email'] }}</p>
                                            <p class="adress-details-para">{{ optional($shipping)['phone'] }}</p>
                                        </div>
                                        <div class="shipping-adress-butn">
                                            <a href="{{ route('checkout') }}" class="shipping-adress-edit">Edit</a>
                                        </div>
                                    </div>

                                    <div class="payment-method-wrapper">
                                        <div class="shipping-adress-details">
                                            <h3 class="adress-details-head">Payment</h3>
                                            <p class="adress-details-para">Card Number:********{{ substr(optional($payment)['card_number'], -4) }}</p>
                                            <p class="adress-details-para">Expiry Date: {{ optional($payment)['expiry_month'] }} - {{ optional($payment)['expiry_year'] }}</p>
                                        </div>
                                        <div class="shipping-adress-butn">
                                            <a href="{{ route('checkout') }}" class="shipping-adress-edit">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                @if (!$is_shipping_billing_same)
                                <div class="order-detail div-float">
                                    <div class="payment-method-wrapper w-100">
                                        <div class="shipping-adress-details w-100">
                                            <h3 class="adress-details-head">Billing Address</h3>
                                            <p class="adress-details-para">{{ optional($billing)['first_name'] }} {{ optional($billing)['last_name'] }}</p>
                                            <p class="adress-details-para">{{ optional($billing)['address'] }}, {{ optional($billing)['state'] }}</p>
                                            <p class="adress-details-para">{{ optional($billing)['city'] }} {{ optional($billing)['zip_code'] }}</p>
                                            <p class="adress-details-para">United States</p>
                                            <p class="adress-details-para">{{ optional($billing)['email'] }}</p>
                                            <p class="adress-details-para">{{ optional($billing)['phone'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="order-place div-float">
                                    <h3 class="order-place-head div-float">Your Order ({{ $products->count() }} Item(s))</h3>
                                    @foreach ($products as $product)
                                        <div class="order-detail-wrapper div-float">
                                            <div class="order-place-pic" style="background-image:url('{{ $product->associatedModel->feature_image }}')"></div>
                                            <div class="order-place-text">
                                                <a href="{{ url('products/' . $product->associatedModel->slug) }}" class="order-place-anchor">{{ $product->name ?? '' }}</a>
                                                <p class="order-place-para">Quantity: {{ $product->quantity }}</p>
                                            </div>
                                            <div class="order-place-price">
                                                <p class="order-place-rate">${{ number_format($product->getPriceSum(), 2) }}</p>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <!-- order summary -->
                            <div class="order-confirm-wrapper order-place-summary div-float">
                                <div class="shipping-form-inputs sp-wid-dev">
                                    <livewire:frontend.cart.order-summary :hideCoupon="true" />
                                    <!-- continue-button -->
                                    <div class="cart-pay-butn div-float">
                                        <form action="{{ route('confirm-order.store') }}" method="post">
                                            @csrf
                                            <button type="submit" class="ship-continue-butn sp-wid-dev-2 general-btn">Place Order</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
