@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Orders
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <livewire:order::order-table-component/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
