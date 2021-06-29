@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Roles
                        </h4>
                        <a href="{{ route(config('core.routeNamePrefix').'users.index') }}" class="btn btn-primary">
                            Back to List
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route(config('core.routeNamePrefix').'users.roles.store',$user) }}" method="POST">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-12 mb-2">
                                        <ul class="list-group">
                                        @foreach ($roles as $role)
                                            <li class="d-block">
                                                <div class="list-group-item  vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" name="roles[]" id="{{$role->id}}" value="{{$role->id}}" {{ $user->hasRole([$role->name]) ? 'checked' : ''  }} class="group-header">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">
                                                        <h3>
                                                            {{ $role->name }}
                                                        </h3>
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-lg btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
