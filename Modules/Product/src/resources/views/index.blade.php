@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Products
                        </h4>
                        <a href="{{ route(config('product.routeNamePrefix').'products.create') }}" class="btn btn-primary">
                            Add Product
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <livewire:product::table-component/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
