@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Coupons
                        </h4>
                        <a href="{{ route(config('coupon.routeNamePrefix').'coupons.create') }}" class="btn btn-primary">
                            Add Coupon
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <livewire:coupon::table-component/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
