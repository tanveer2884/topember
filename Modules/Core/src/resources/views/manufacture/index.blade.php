@extends('layouts.master')

@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Manufacture
                        </h4>
                        <a href="{{ route('admin.manufactures.create')  }}" class="btn btn-primary">Create Manufacture</a>
                    </div>
                    <div class="card-content">
                        <livewire:manufacture-table-component/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
