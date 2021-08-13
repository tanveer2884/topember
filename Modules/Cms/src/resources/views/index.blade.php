@extends('layouts.master')

@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Pages
                        </h4>
                        <a href="{{ route(config('cms.routeNamePrefix').'pages.create')  }}" class="btn btn-primary">Create Page</a>
                    </div>
                    <div class="card-content">
                        <livewire:cms::table-component/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
