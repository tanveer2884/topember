@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Product Attributes
                        </h4>
                        <a href="{{ route(config('product.routeNamePrefix').'products.index') }}" class="btn btn-primary">
                            List Products
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <livewire:product::add-product-attributes-component :product="$product" />
                            <hr>
                            <livewire:product::product-attributes-table-component :product="$product"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
