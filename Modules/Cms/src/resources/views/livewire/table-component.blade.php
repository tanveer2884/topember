<div class="pt-1 position-relative">
    <table class="table table-responsive-md mb-0">
        <thead>
        <tr>
            <th>
                <input class="form-control" placeholder="Search By title" type="search" wire:model.debounce.500ms="title">
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>
                <a href="javascript:void(0);" wire:click="sort('title')">
                    Title
                </a>
                @if ($orderBy == 'title')
                    {!! $sortArrow !!}
                @endif
            </th>
            <th>Slug</th>
            <th class="text-center">
                <a href="javascript:void(0);" wire:click="sort('is_active')">
                    Active
                </a>
                @if ($orderBy == 'is_active')
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
        @foreach($pages as $page)
            <tr>
                <td>
                    {{ $page->title }}
                </td>
                <td>
                    {{ $page->slug }}
                </td>
                <td class="text-center">
                    <div>
                        <livewire:status-toggle-component :key="$page->getUniqueKey('status')" :model="$page" />
                    </div>
                </td>
                <td>
                    {{ $page->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">

                                <a href="{{ route(config('cms.routeNamePrefix').'pages.edit',$page) }}" title="Edit Page" class="dropdown-item w-100">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                
                                <a target="_blank" href="{{ route(config('cms.routeNamePrefix').'page-customize.index',$page) }}" title="Customize Page" class="dropdown-item w-100">
                                    <i class="fa fa-cog"></i> Customize
                                </a>

                                @if( !$page->isStandard())
                                <button class="dropdown-item w-100 text-danger position-relative" wire:click="$emit('confirmDelete','{{$page->id}}')">
                                    <i class="feather icon-trash-2"></i> Delete
                                    @include('layouts.livewire.button-loading')
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $pages->links() }}
    </div>
    @include('layouts.livewire.loading')
</div>
