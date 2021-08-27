@extends('frontend.layouts.master')

@section('meta_title','Manage Orders')
@section('meta_description','')

@section('page')

    <div class="inner-section">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="account-main">
                            <div class="row">
                                <div class="col-md-4">
                                    @include('frontend.account.layouts.account-menu')
                                </div>

                                <div class="col-md-8">
                                    <div class="my-orders-main">
                                        <div class="my-order-head div-flex">
                                            <h1>MY ORDERS</h1>

                                            <livewire:frontend.order.order-search />
                                        </div>

                                        <livewire:frontend.order.order-listing />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
