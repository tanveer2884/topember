@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Users
                        </h4>
                        <a href="{{ route(config('core.routeNamePrefix').'users.index') }}" class="btn btn-primary">
                            Back to list
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @foreach ( collect($user->toArray())->only(config('core.displayFields.users')) as $key => $name)
                                <div class="row my-1">
                                    <div class="col-md-4">
                                        <strong>{{ Str::of($key)->replace('_',' ')->title() }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $name }}
                                    </div>
                                </div>    
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
