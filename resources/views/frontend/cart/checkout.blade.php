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
                            <div class="cart-main-heading div-float sp-under-bor">
                                <h2 class="cart-main-head-style div-float">CHECKOUT</h2>
                            </div>
                            <!-- shipping-form -->
                            <div class="shipping-form-wrapper div-float">
                                <div class="shipping-form-inputs div-float">
                                    <div class="specific-form">
                                        <livewire:frontend.cart.billing-and-checkout />

                                        @guest
                                            <!-- order summary as a guest  -->
                                            <div class="under-border-sp-div div-float"></div>
                                            <div class="pay-oder-sum-wrap div-float">
                                                <h2 class="shipping-main-head-style div-float">Order Summary</h2>
                                            </div>
                                            <livewire:frontend.cart.order-summary :sidebar="false" />
                                            <div class="cart-pay-butn div-float">
                                                <button onclick="livewire.emit('save-billing-shipping')" class="ship-continue-butn general-btn position-relative">
                                                    complete purchase
                                                    @include('layouts.livewire.button-loading')
                                                </button>
                                            </div>
                                            <!-- order summary as a guest  -->
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- hidden sign in form -->
                        @guest
                            <div class="cart-scnd-container sticky-top">
                                <livewire:frontend.auth.login-controller redirect="{{ route('checkout') }}" :checkout="true" />
                            </div>
                        @endguest
                        <!-- new side order summary added -->
                        @auth
                            <div class="cart-scnd-container sticky-top">
                                <div class="cart-scnd-wrapper div-float">
                                    <h2 class="order-summary-heading div-float">Order Summary</h2>
                                    <livewire:frontend.cart.order-summary />
                                    <div class="clearfix"></div>
                                    <div class="check-out-butn-wraper">
                                        <button onclick="livewire.emit('save-billing-shipping')" class="check-out-butn general-btn position-relative">
                                            CHECKOUT
                                            @include('layouts.livewire.button-loading')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection