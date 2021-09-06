@component('mail::message')

@component('mail::panel')

@if ($toAdmin)

# Order Confirmation 

Hi Admin, <br>
Someone’s submitted an order.    
@endif

<h1 style="text-align:center;"> {{ $toAdmin ? 'Order Summary' : 'Invoice' }} </h1>
<p style="text-align:center;margin:0;">Order#: {{ $order->order_id }}</p>
<p style="text-align:center;margin:0;">Date: {{ $order->created_at->format('M d, Y') }}</p>

@endcomponent

# Order Details <br>
<strong>Payment Method:</strong>Credit Card <br>
<hr>
<div style="width:100%;display: flex; align-items:start; justify-content:space-around;">
<div style="width: 50%;padding:0 10px;">

# Shipping {{ $order->isShippingBillingSame() ? "/Billing" :'' }} Address

{{ $order->shipping_address }},
{{ $order->shipping_address2 }} <br>
{{ $order->shipping_name }} <br>
{{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_zipCode }} <br>
{{ $order->shipping_phone }} <br>
{{ $order->shipping_email }} <br>
</div>

@if(!$order->isShippingBillingSame())
<div style="width: 50%;padding:0 10px;">

# Billing Address

{{ $order->billing_address }},
{{ $order->billing_address2 }} <br>
{{ $order->billing_name }} <br>
{{ $order->billing_city }}, {{ $order->billing_state }}, {{ $order->billing_zipCode }} <br>
{{ $order->billing_phone }} <br>
{{ $order->billing_email }} <br>
</div>
@endif

</div>

<div style="width: 50%; padding:0 10px;">

# Payment Info

@if($order->paymentProfile)
<p>Card Number **********{{ $order->paymentProfile->card_last }}</p>
<p>Expiry Date : {{ $order->paymentProfile->expiry }}</p>
@else
<p>Card Number **********{{ $order->payment_info_card_number }}</p>
<p>Expiry Date : {{ $order->payment_info_expiry }}</p>
@endif
</div>

@component('mail::table')
| Item          |   Unit Price   | Quantity          | Total                   |
| :------------- |:--------------:|:-----------------:| -----------------------:|
@foreach($order->cart  as $item)
|  <div style="display: flex;align-items:center;justify-content:space-around;"><img style="width: 50px;height:50px;" src="{{ optional($item->model)->feature_image }}" alt=""> <div><strong>{{$item->name}}</strong></div></div> |   ${{number_format($item->price,2)}}    |   {{$item->quantity}} |   ${{number_format($item->getPriceSum(),2)}}    |
@endforeach
|   |     |  <strong>Sub Total</strong>   |   ${{number_format($order->subtotal,2)}}    |
@if($order->discount)
|   |     |  <strong>Discount</strong>   |   ${{number_format($order->discount,2)}}    |
@endif
|   |     |  <strong>Shipping</strong>   |   ${{number_format($order->shipping,2)}}    |
|   |     |  <strong>Tax</strong>   |   ${{number_format($order->tax,2)}}    |
|   |     |  <strong>Total</strong>   |   ${{number_format($order->total,2) }}   |
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
