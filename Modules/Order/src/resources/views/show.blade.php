@extends('layouts.master')

@section('page')

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="accnt-rgt-main">
                <div class="acctrgt-top">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="accrgt-tit">
                                <h4>My Orders</h4>
                                <p>View & track orders</p>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="acct-rgtlwr-sec">
                    <div class="my-profle-frm">
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <strong>Order Date: </strong> {{ $order->created_at->format('M d, Y') }}
                                </div>
                                <div class="form-group mb-1">
                                    <strong>Tacking Number: </strong> {{ $order->tracking_number ?? 'Not Available' }}
                                </div>

                                <div class="form-group mb-1">
                                    <strong>Payment Method: </strong> Credit Card
                                </div>

                                <livewire:order::order-status-component :order="$order" />
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="deflt-addrs-bx pt-4 pb-4">
                                    <div class="deflt-addrs-head">
                                        <div class="dah-lft">
                                            <h5>Shipping {{ $order->isShippingBillingSame() ? "/Billing" :'' }} Address</h5>
                                        </div>
                                    </div>

                                    <div class="deflt-addrs-name">
                                        <h6>{{ $order->shipping_name }}</h6>

                                        <p>{{ $order->shipping_address }}</p>
                                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_zipCode }}</p>
                                        <p>United States</p>
                                        <p>{{ $order->shipping_phone }}</p>
                                        <p>&nbsp;</p>
                                        <p>{{ $order->shipping_email }}</p>
                                    </div>
                                </div>
                            </div>


                            @if( !$order->isShippingBillingSame() )

                            <div class="col-md-6">
                                <div class="deflt-addrs-bx pt-4 pb-4">
                                    <div class="deflt-addrs-head">
                                        <div class="dah-lft">
                                            <h5>Billing Address</h5>
                                        </div>
                                    </div>

                                    <div class="deflt-addrs-name">
                                        <h6>{{ $order->billing_name }}</h6>

                                        <p>{{ $order->billing_address }}</p>
                                        <p>{{ $order->billing_city }}, {{ $order->billing_state }}</p>
                                        <p>United States</p>
                                        <p>{{ $order->billing_phone }}</p>
                                        <p>&nbsp;</p>
                                        <p>{{ $order->billing_email }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="deflt-addrs-bx pt-4 pb-4">
                                    <div class="deflt-addrs-head ">
                                        <div class="dah-lft">
                                            <h5>Payment</h5>
                                        </div>
                                    </div>

                                    <div class="deflt-addrs-name">

                                        <p class="mb-2">
                                            <img src="/images/visa.png" alt="VISA" class="img-fluid">
                                        </p>

                                        @if($order->paymentProfile)
                                        <p>Card Number **********{{ $order->paymentProfile->card_last }}</p>
                                        <p>Expiry Date : {{ $order->paymentProfile->expiry }}</p>
                                        @else
                                        <p>Card Number **********{{ $order->payment_info_card_number }}</p>
                                        <p>Expiry Date : {{ $order->payment_info_expiry }}</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="cart-accordian order-dtl-accordian mb-0">
                        <div class="card">
                            <div id="collapseOne" class="collapse show">
                                <div class="card-body">

                                    <table class="table table-borderd">
                                        <colgroup>
                                            <col width="15%" />
                                            <col width="50%" />
                                            <col width="20%" />
                                            <col width="15%" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th style="text-align: center;">Quanity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->cart as $cartItem)
                                            <tr>
                                                <td>
                                                    <img style="width: 100px;height:100px;" src="{{ $cartItem->associatedModel->feature_image }}" alt="" class="img-fluid">
                                                </td>
                                                <td>
                                                    {{ $cartItem->name }}
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $cartItem->quantity }}
                                                </td>
                                                <td>
                                                    ${{ number_format($cartItem->getPriceSum(),2) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="crt-prdt-items">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="sstdt-list pb-2 row">
                                <h4 class="col-6">Subtotal</h4>
                                <p class="col-6">${{ number_format($order->subtotal,2) }}</p>
                            </div>

                            @if($order->discount)
                            <div class="sstdt-list row">
                                <h4 class="col-6">Discount</h4>
                                <p class="col-6">${{ number_format($order->discount,2) }}</p>
                            </div>
                            @endif

                            <div class="sstdt-list row">
                                <h4 class="col-6">Shipping</h4>
                                <p class="col-6">FREE</p>
                            </div>

                            <div class="sstdt-list row">
                                <h4 class="col-6">Tax</h4>
                                <p class="col-6">${{ number_format($order->tax,2) }}</p>
                            </div>


                            <div class="sstdt-list ordr-total row">
                                <h3 class="col-6">Order Total</h3>
                                <h3 class="col-6">${{ $order->total }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
