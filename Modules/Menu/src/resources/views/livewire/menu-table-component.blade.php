<div class="card-content">
    <div class="pt-1">
        <table class="table table-responsive-md mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>
                            {{ $menu->name }}
                        </td>
                        <td>
                            {{ $menu->created_at->format('m-d-Y g:i:s a') }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                        Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropright">
                                        
                                        <a href="{{ route( config('menu.routeNamePrefix').'menus.builder',$menu) }}" title="Build Menu" class="dropdown-item w-100">
                                            <i class="fa fa-cog"></i> Builder
                                        </a>

                                        <a href="javascript:void(0);" wire:click="$emit('edit-item','{{$menu->id}}')" title="Edit Menu" class="dropdown-item w-100">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a href="javascript:void(0);" wire:click="$emit('confirmDelete','{{$menu->id}}')" title="Delete Menu" class="text-danger dropdown-item w-100">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end px-2 mx-2 my-2">
            {{ $menus->links() }}
        </div>
    </div>
    @include('layouts.livewire.loading')
</div>
