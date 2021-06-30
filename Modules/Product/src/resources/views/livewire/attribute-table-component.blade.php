<div>
    <table class="table table-hover table-responsive-md">
        <thead>
            <tr>
                <th colspan="7">
                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <input type="search" placeholder="Search Attribute By Name" class="form-control" wire:model.debounce.500ms="search">
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>
                    <a href="javascript:void(0);" class="py-0" wire:click="sort('name')">
                        Name
                        {!! $this->sortingInfo('name') !!}
                    </a>
                </th>
                <th>
                    <a href="javascript:void(0);" class="py-0" wire:click="sort('created_at')">
                        Created At
                        {!! $this->sortingInfo('created_at') !!}
                    </a>
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($attributes as $attribute)
            <tr>
                <td>
                    {{ $attribute->name }}
                </td>
                
                <td>
                    {{ $attribute->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">
                                <a href="{{ route(config('product.routeNamePrefix').'attributes.edit',$attribute) }}" class="dropdown-item btn btn-block">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                <a href="{{ route(config('product.routeNamePrefix').'attributes.values.index',$attribute) }}" class="dropdown-item btn btn-block">
                                    <i class="fa fa-list"></i>
                                    Values
                                </a>
                                <button class="text-danger dropdown-item btn btn-block" wire:click="delete('{{$attribute->id}}')">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="3">
                    <h4 class="text-center">
                        No Attributes Found
                    </h4>
                </th>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $attributes->links() }}
    </div>

    @include('layouts.livewire.loading')
</div>