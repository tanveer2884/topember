@extends('frontend.account.layouts.my-account')

@section('meta_title','Manage Orders')
@section('meta_description','')

@section('account-page')

<div class="my-orders-main">
    <div class="my-order-head div-flex">
        <h1>MY ORDERS</h1>
        <livewire:frontend.order.order-search />
    </div>

    <livewire:frontend.order.order-listing />

</div>

@endsection
