<div class="pt-1 position-relative">
    <table class="table table-responsive-md mb-0">
        <thead>
            <tr>
                <th>
                    <input class="form-control" placeholder="Search By Name" type="search" wire:model.debounce.500ms="search">
                </th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>
                    Image
                </th>
                <th>
                    <a href="javascript:void(0);" wire:click="sort('name')">
                        Name
                    </a>
                    @if ($orderBy == 'name')
                    {!! $sortArrow !!}
                    @endif
                </th>
                <th>
                    <a href="javascript:void(0);" wire:click="sort('created_at')">
                        Created At
                    </a>
                    @if ($orderBy == 'created_at')
                    {!! $sortArrow !!}
                    @endif
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($manufactures as $manufacture)
            <tr>
                <td>
                    <img src="{{ $manufacture->getImage() }}" alt="" style="width: 100px;height:100px;">
                </td>
                <td>
                    {{ $manufacture->name }}
                </td>

                <td>
                    {{ $manufacture->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">

                                <a href="{{ route('admin.manufactures.edit',$manufacture) }}" title="Edit Page" class="dropdown-item w-100">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <button class="dropdown-item w-100 text-danger position-relative" wire:click="$emit('confirmDelete','{{$manufacture->id}}')">
                                    <i class="feather icon-trash-2"></i> Delete
                                    @include('layouts.livewire.button-loading')
                                </button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $manufactures->links() }}
    </div>
    @include('layouts.livewire.loading')
</div>
