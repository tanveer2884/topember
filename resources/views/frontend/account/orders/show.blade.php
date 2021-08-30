@extends('frontend.account.layouts.my-account')

@section('meta_title','View Order')
@section('meta_description','')

@section('account-page')

<div class="my-cart-main-wrapper order-detail-wrapper">
    <div class="my-cart-wrapper">
        <div class="cart-first-container">
            <div class="order-confirm-heading div-float">
                <h2 class="shipping-main-head-style div-float">Orders Detail
                    <span class="float-right" style="font-size: 14px;" >Tracking#: {{$order->tracking_number}}</span>
                </h2>
            </div>
            <div class="clearfix"></div>
            <!-- order-deatil -->

            <div class="order-detail-wrapper div-float">
                <div class="order-detail div-float">
                    <div class="payment-method-wrapper">
                        <div class="shipping-adress-details">
                            <h3 class="adress-details-head">Shipping Address</h3>
                            <p class="adress-details-para mb-3">
                                {{ $order->shipping_name ?? '' }}<br/>
                                {{ $order->shipping_address }}, {{ $order->shipping_address2 }}<br/>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_zipCode }}<br/>
                                United States<br/>
                                {{ $order->shipping_phone }} <br/><br/>
                                {{ $order->shipping_email }}
                            </p>
                        </div>
                    </div>
                    <div class="payment-method-wrapper">
                        <div class="shipping-adress-details">
                            <h3 class="adress-details-head">Payment</h3>
                            <p class="adress-details-para"> <strong>Name On Card:</strong> {{$order->payment_info_name}} </p>
                            <p class="adress-details-para"><strong> Card Number:</strong> ************{{ $order->payment_info_card_number }}</p>
                            <p class="adress-details-para"><strong>Expiry Date:</strong> {{ $order->payment_info_expiry }}</p>
                        </div>
                    </div>
                </div>
                <div class="order-detail div-float">
                    <div class="payment-method-wrapper">
                        <div class="shipping-adress-details">
                            <h3 class="adress-details-head">Billing Address</h3>
                            <p class="adress-details-para mb-3">
                                {{ $order->billing_name ?? ''}}<br/>
                                {{ $order->billing_address }} {{ $order->billing_address2 }}2<br/>
                                {{ $order->billing_city }}, {{ $order->billing_state }}, {{ $order->billing_zipCode }}<br/>
                                United States<br/>
                                {{ $order->billing_phone }} <br/><br/>
                                {{ $order->billing_email }}
                            </p>
                        </div>
                    </div>
                </div>
                @if($order->cart)
                    @foreach($order->cart as $cartItem)
                        <div class="order-place div-float">
                        <h3 class="order-place-head div-float">Your Order ({{$cartItem->count()}} Item(s))</h3>
                        <div class="order-place-pic" style="background-image:url('{{ $cartItem->associatedModel->feature_image }}')"></div>
                        <div class="order-place-text">
                            <a href="#" class="order-place-anchor">{{ $cartItem->name }}</a>
                            <p class="order-place-para">Quantity: {{ $cartItem->quantity }}</p>
                        </div>
                        <div class="order-place-price">
                            <p class="order-place-rate">${{ number_format($cartItem->getPriceSum(),2) }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>

            <!-- order summary -->
            <div class="order-confirm-wrapper pb-0 order-place-summary div-float">
                <div class="shipping-form-inputs sp-wid-dev">

                    <div class="pay-oder-detail-wrap div-float">
                        <div class="pay-oder-detail-left">
                            <p class="order-pay-1 ord-plc-left">Subtotal:</p>
                            <p class="order-pay-2 ord-plc-right">${{ number_format($order->subtotal,2) }}</p>
                            <p class="order-pay-3 ord-plc-left">Tax:</p>
                            <p class="order-pay-4 ord-plc-right">${{ number_format($order->tax,2) }}</p>
                            <p class="order-pay-5 ord-plc-left">Shipping:</p>
                            <p class="order-pay-6 ord-plc-right">${{ number_format($order->shipping,2) }}</p>
                            <div class="hr hr-sp-pay ord-plc-line"></div>
                            <p class="order-pay-7 ord-plc-left">Total</p>
                            <p class="order-pay-8 ord-plc-right">${{ number_format($order->total,2) }}</p>
                            <div class="hr hr-sp-pay ord-plc-line"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
