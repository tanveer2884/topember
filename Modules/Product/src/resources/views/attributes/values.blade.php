@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Attribute Values
                        </h4>
                        <a href="{{ route(config('product.routeNamePrefix').'attributes.index') }}" class="btn btn-primary">
                            List Attribute
                        </a>
                    </div>
                    <div class="card-content">
                        
                        <div class="card-body">
                            <livewire:product::add-edit-attribute-value-component :attribute="$attribute" />
                            <hr>
                            <livewire:product::attribute-value-table-component :attribute="$attribute"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
