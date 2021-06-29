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
                    <a href="{{ route(config('core.routeNamePrefix').'roles.create')  }}" class="btn btn-primary">Create Role</a>
                </div>
                <div class="card-content">
                    <div class="pt-1">
                        <table class="table table-responsive-md mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr class="{{ $role->isSuperAdmin() ?'bg-danger text-white':''  }}">
                                    <td>
                                        @if ($role->isSuperAdmin())
                                        {{ Str::of($role->name)->snake('_')->replace('_',' ')->title() }}
                                        @else
                                        {{ $role->name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $role->description }}
                                    </td>
                                    <td>
                                        {{ $role->created_at->format('m-d-Y g:i:s a')  }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropright">

                                                    <a href="{{ route(config('core.routeNamePrefix').'roles.show',$role) }}" title="View Role" class="dropdown-item w-100">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>

                                                    <a href="{{ route(config('core.routeNamePrefix').'roles.permissions.index',$role) }}" title="Edit Role Permissions" class="dropdown-item w-100">
                                                        <i class="fa fa-key"></i> Permissions
                                                    </a>

                                                    <a href="{{ route(config('core.routeNamePrefix').'roles.edit',$role) }}" title="Edit Role" class="dropdown-item w-100">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>

                                                    <form action="{{ route(config('core.routeNamePrefix').'roles.destroy',$role) }}" class="d-flex" method="post" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item w-100 text-danger">
                                                            <i class="feather icon-trash-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end px-2 mx-2 my-2">
                            {{ $roles->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection