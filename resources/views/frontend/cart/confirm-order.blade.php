@extends('frontend.layouts.master')

@section('title','Confirm Order')
@section('description','Confirm Order')

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
                                            <h3 class="adress-details-head">Shipping Address</h3>
                                            <p class="adress-details-para">{{ optional($shippingInfo)->first_name }} {{ optional($shippingInfo)->last_name }}</p>
                                            <p class="adress-details-para">{{ optional($shippingInfo)->address }}, {{ optional($shippingInfo)->state }}</p>
                                            <p class="adress-details-para">{{ optional($shippingInfo)->city }} {{ optional($shippingInfo)->zip_code }}</p>
                                            <p class="adress-details-para">United States</p>
                                        </div>
                                        <div class="shipping-adress-butn">
                                            <a href="#" class="shipping-adress-edit">Edit</a>
                                        </div>
                                    </div>

                                    <div class="payment-method-wrapper">
                                        <div class="shipping-adress-details">
                                            <h3 class="adress-details-head">Payment</h3>
                                            <p class="adress-details-para">Card Number:************{{substr( optional($paymentProfile)->card_number,-4) }}</p>
                                            <p class="adress-details-para">Expiry Date: {{ optional($paymentProfile)->expiry_month }} - {{ optional($paymentProfile)->expiry_year }}</p>
                                        </div>
                                        <div class="shipping-adress-butn">
                                            <a href="#" class="shipping-adress-edit">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-detail div-float">
                                    <div class="payment-method-wrapper w-100">
                                        <div class="shipping-adress-details w-100">
                                            <h3 class="adress-details-head">Billing Address</h3>
                                            <p class="adress-details-para">{{ optional($billingInfo)->first_name }} {{ optional($billingInfo)->last_name }}</p>
                                            <p class="adress-details-para">{{ optional($billingInfo)->address }}, {{ optional($billingInfo)->state }}</p>
                                            <p class="adress-details-para">{{ optional($billingInfo)->city }} {{ optional($billingInfo)->zip_code }}</p>
                                            <p class="adress-details-para">United States</p>
                                        </div>
                                        <!-- <div class="shipping-adress-butn">
                                            <a href="#" class="shipping-adress-edit">Edit</a>
                                        </div> -->
                                    </div>
                                    <!-- <div class="payment-method-wrapper">
                                        <div class="shipping-adress-details">
                                            <h3 class="adress-details-head">Payment</h3>
                                            <p class="adress-details-para">Card Number:************1234</p>
                                            <p class="adress-details-para">Expiry Date: 12-21</p>
                                        </div>
                                        <div class="shipping-adress-butn">
                                            <a href="#" class="shipping-adress-edit">Edit</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="order-place div-float">
                                    <h3 class="order-place-head div-float">Your Order ({{$products->count()}} Item(s))</h3>
                                    @foreach($products as $product)
                                        <div class="order-place-pic" style="background-image:url('{{ $product->associatedModel->feature_image }}')"></div>
                                        <div class="order-place-text">
                                            <a href="{{url('products/'.$product->associatedModel->slug)}}" class="order-place-anchor">{{$product->name ?? ''}}</a>
                                            <p class="order-place-para">Quantity: {{$product->quantity}}</p>
                                        </div>
                                        <div class="order-place-price">
                                            <p class="order-place-rate">${{ number_format($product->getPriceSum(),2) }}</p>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <!-- order summary -->
                            <div class="order-confirm-wrapper order-place-summary div-float">
                                <div class="shipping-form-inputs sp-wid-dev">
                                    <livewire:frontend.cart.order-summary :hideCoupon="true"/>
                                   {{-- <div class="pay-oder-detail-wrap div-float">
                                        <div class="pay-oder-detail-left">
                                            <p class="order-pay-1 ord-plc-left">Subtotal:</p>
                                            <p class="order-pay-2 ord-plc-right">$89.98</p>
                                            <p class="order-pay-3 ord-plc-left">Tax:</p>
                                            <p class="order-pay-4 ord-plc-right">$4.99</p>
                                            <p class="order-pay-5 ord-plc-left">Shipping:</p>
                                            <p class="order-pay-6 ord-plc-right">$0</p>
                                            <p class="order-pay-5 ord-plc-left">Discount:</p>
                                            <p class="order-pay-6 ord-plc-right">$0</p>
                                            <div class="hr hr-sp-pay ord-plc-line"></div>
                                            <p class="order-pay-7 ord-plc-left">Total</p>
                                            <p class="order-pay-8 ord-plc-right">$94.99</p>
                                            <div class="hr hr-sp-pay ord-plc-line"></div>
                                        </div>
                                    </div>--}}

                                    <!-- continue-button -->
                                    <div class="cart-pay-butn div-float">
                                        <form action="{{route('confirm-order.store')}}" method="post">
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
