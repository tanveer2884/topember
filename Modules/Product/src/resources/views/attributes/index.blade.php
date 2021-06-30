@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Attributes
                        </h4>
                        <a href="{{ route(config('product.routeNamePrefix').'attributes.create') }}" class="btn btn-primary">
                            Add Attribute
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <livewire:product::attribute-table-component/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
