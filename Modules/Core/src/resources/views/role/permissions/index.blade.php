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
                            <form action="{{route(config('core.routeNamePrefix').'roles.permissions.store',$role)}}" method="post">
                                @csrf
                                <div class="pt-1">
                                    <h5 class="border-bottom mb-3">Permissions</h5>
                                    @forelse( $modules as $module => $permissions )
                                        <h5>==> {{ Str::studly($module)  }}</h5>
                                        <hr>
                                        <ul class="list-style-square">
                                            @foreach($permissions as $permission)
                                                <li class="d-flex align-items-center border p-1 mb-1 ">
                                                    <input type="checkbox" name="permissions[]" {{ $role->hasPermission($permission->slug) ? 'checked': '' }} id="{{$permission->id}}" value="{{$permission->id}}">
                                                    <label class="w-100 ml-1 cursor-pointer" for="{{$permission->id}}">
                                                        <h6>{{ $permission->slug }}</h6>
                                                        <small>{{ $permission->description }}</small>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @empty
                                        <p class="text-warning">No Permission Available</p>
                                    @endforelse
                                </div>
                                <div class="row mt-1 justify-content-center">
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                            Update
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
