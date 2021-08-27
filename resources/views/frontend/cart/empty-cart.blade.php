@extends('frontend.layouts.master')

@section('title','')
@section('description','')

@section('page')
<div class="empty-cart-main-wrapper">
    <div class="empty-cart-wrapper">
        <img src="{{ asset('images/empty-cart.png') }}" alt="empty-cart">
        <h2>
            Your cart is empty, but it
            doesn't have to be.
        </h2>

        <p class="thanks-para-bold">
            <a href="{{ route('product.index') }}">Click here</a>
            to fill it up!
        </p>
    </div>
</div>
@endsection