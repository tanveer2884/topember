@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h4 class="mb-0">
                                {{ $role->name }}
                            </h4>
                            <p>{{$role->description}}</p>
                        </div>

                        <a href="{{ route(config('core.routeNamePrefix').'roles.index')  }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <hr>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="pt-1">
                                <h5 class="border-bottom mb-2">Permissions</h5>
                                @forelse( $role->modules() as $module => $permissions )
                                    <h5>==> {{ Str::studly($module) }}</h5>
                                    <hr>
                                    <ul style="list-style-type: none">
                                        @foreach($permissions as $permission)
                                            <li class="border w-100 p-1 mb-1">
                                                <h6>{{ $permission->slug }}</h6>
                                                <small>{{ $permission->description }}</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                @empty
                                    <p class="text-warning">No Permission granted</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
