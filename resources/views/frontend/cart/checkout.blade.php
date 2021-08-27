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
                            <div class="shipping-main-heading sp-pad-new-left div-float">
                                <h2 class="shipping-main-head-style div-float">Shipping Information</h2>
                            </div>
                            <div class="clearfix"></div>
                            <!-- shipping-form -->
                            <div class="shipping-form-wrapper div-float">
                                <div class="shipping-form-inputs div-float">
                                    <div class="specific-form">
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <!-- <label for="exampleFormControlSelect1">select from save adress</label> -->
                                                        <select class="form-control" id="exampleFormControlSelect1">
                                                            <option>select from save address</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Last Name">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Address">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="City">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="State">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Zip Code">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- check-box -->
                                            <div class="my-cart-check-box pt-3 pl-3 mb-3 div-float">
                                                <div class="form-group ch-box-1">
                                                    <input type="checkbox" onclick="showBilling();" id="html">
                                                    <label for="html">Same as Shipping</label>
                                                </div>
                                            </div>

                                            <div class="billing-form-main" id="billing-form">
                                                <!-- billing-information -->
                                                <div class="billing-main-heading pt-3 div-float">
                                                    <h2 class="shipping-main-head-style div-float">Billing Information</h2>
                                                </div>

                                                <!-- billing-form -->
                                                <div class="row div-float">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <!-- <label for="exampleFormControlSelect1">select from save adress</label> -->
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option>select from save address</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Last Name">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Address">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="City">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="State">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Zip Code">
                                                            <div class="error d-none">error goes here!</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- payment-information -->
                                            <div class="billing-main-heading pt-3 div-float">
                                                <h2 class="shipping-main-head-style  div-float">Payment information</h2>
                                            </div>
                                            <!-- billing-form -->
                                            <div class="row div-float">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <!-- <label for="exampleFormControlSelect1">select from save adress</label> -->
                                                        <select class="form-control" id="exampleFormControlSelect1">
                                                            <option>select from save payment</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 d-none">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 d-none">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Last Name">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Credit Card Number">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Exp Month">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Exp Year">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="CSC">
                                                        <div class="error d-none">error goes here!</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       @guest
                                         <!-- order summary as a guest  -->
                                         <div class="under-border-sp-div div-float"></div>
                                         <div class="pay-oder-sum-wrap div-float">
                                             <h2 class="shipping-main-head-style div-float">Order Summary</h2>
                                         </div>
                                         <livewire:frontend.cart.order-summary :sidebar="false" />
                                         <div class="cart-pay-butn div-float">
                                             <a href="{{ route('confirm-order') }}" class="ship-continue-butn general-btn">complete purchase</a>
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
                            <livewire:frontend.auth.login-controller redirect="{{route('checkout')}}" :checkout="true" />
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
                                    <a href="{{ route('confirm-order') }}" class="check-out-butn general-btn">CHECKOUT</a>
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
