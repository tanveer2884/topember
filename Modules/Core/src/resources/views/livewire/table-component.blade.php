<div class="pt-1 position-relative">
    <div class="actions d-flex w-100 px-2 justify-content-end">
        <div id="bulk-actions" style="display: none">
            <a href="javascript:void(0);" class="btn btn-primary" wire:click="markActive">
                <i class="fa fa-download"> Mark Active</i>
            </a>
            <a href="javascript:void(0);" class="btn btn-danger ml-2" wire:click="markInactive">
                <i class="fa fa-download"> Mark Inactive</i>
            </a>
        </div>
        
        <a class="btn btn-primary ml-2" href="{{ route(config('core.routeNamePrefix').'import-users.index') }}">
            <i class="fa fa-upload"> Import</i>
        </a>
        <a class="btn btn-primary ml-2" href="{{$downloadLink}}">
            <i class="fa fa-download"> Export</i>
        </a>
        
    </div>
    <table class="table table-responsive-md mb-0">
        <thead>
        <tr>
            <th colspan="3">
                <input type="search" placeholder="Search by Email" class="form-control" wire:model.debounce.500ms="email">
            </th>
            <th>
                <select class="form-control" wire:model.debounce.500ms="active">
                    <option value="-1">All</option>
                    <option value="1">Active</option>
                    <option value="0">In Active</option>
                </select>
            </th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th style="width: 20px;">
                Checkbox
            </th>
            <th>
                <a href="javascript:void(0);" wire:click="sort('name')">
                    Name
                </a>
                @if ($orderBy == 'name')
                    {!! $sortArrow !!}
                @endif
            </th>
            <th>Email</th>
            <th class="text-center">Active</th>
            <th>
                <a href="javascript:void(0);" wire:click="sort('created_at')">
                    Registered At
                </a>
                @if ($orderBy == 'created_at')
                    {!! $sortArrow !!}
                @endif
            </th>
            <th>Action</th>
        </tr>

        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="{{ $user->isAdmin() ? 'bg-danger text-white':'' }}">
                <td>
                    <input class="form-control bulk-checkbox" style="width: 20px;" type="checkbox" wire:model.defer="selectedUsers.{{$user->id}}">
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td class="text-center">
                    <livewire:status-toggle-component :model="$user" :key="$user->getUniqueKey('status')" />
                </td>
                <td >
                    {{ $user->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">

                                <a href="{{ route(config('core.routeNamePrefix').'users.show',$user) }}" title="Edit User" class="dropdown-item w-100">
                                    <i class="fa fa-eye"></i> View
                                </a>

                                <a href="{{ route(config('core.routeNamePrefix').'users.roles.index',$user) }}" title="Edit User Roles" class="dropdown-item w-100">
                                    <i class="fa fa-key"></i> Roles
                                </a>
                                <a href="{{ route(config('core.routeNamePrefix').'users.edit',$user) }}" title="Edit User" class="dropdown-item w-100">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
{{--                                <form action="{{ route(config('core.routeNamePrefix').'users.login',$user) }}" class="d-flex" method="post">--}}
{{--                                    @csrf--}}
{{--                                    <button class="dropdown-item w-100">--}}
{{--                                        <i class="feather icon-lock"></i> Login--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                                <form action="{{ route(config('core.routeNamePrefix').'users.destroy',$user) }}" class="d-flex" method="post" onsubmit="return confirmDelete()">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button class="dropdown-item w-100 text-danger">--}}
{{--                                        <i class="feather icon-trash-2"></i> Delete--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $users->links() }}
    </div>
    @include('layouts.livewire.loading')
</div>

@push('js')

    <script>
        $('body').on('change','.bulk-checkbox',function(){
            if ( $('.bulk-checkbox:checked').length >0 ){
                $('#bulk-actions').show();
            }else{
                $('#bulk-actions').hide();
            }
            
        })
    </script>

@endpush