<div>
    <table class="table table-hover table-responsive-md">
        <thead>
            <tr>
                <th colspan="7">
                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <input type="search" placeholder="Search Product By Name" class="form-control" wire:model.debounce.500ms="search">
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>
                    Thumbnail
                </th>
                <th>
                    <a href="javascript:void(0);" class="btn py-0" wire:click="sort('name')">
                        Name
                        {!! $this->sortingInfo('name') !!}
                    </a>
                </th>
                <th>
                    SKU
                </th>
                <th>
                    Price
                </th>
                <th>
                    Qty
                </th>
                <th>
                    Status
                </th>
                <th>
                    <a href="javascript:void(0);" class="btn py-0" wire:click="sort('created_at')">
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
            @forelse($products as $product)
            <tr>
                <td>
                    @if ($product->hasMedia('feature'))
                    <img src="{{ $product->feature_image }}" style="width: 100px;" alt="">
                    @endif
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->sku }}
                </td>
                <td>
                    {{ $product->price }}
                </td>
                <td>
                    {{ $product->qty }}
                </td>
                <td>
                    @if ($product->isActive())
                    <i class="fa fa-circle text-success"></i>
                    @else
                    <i class="fa fa-circle text-danger"></i>
                    @endif
                </td>
                <td>
                    {{ $product->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">
                                <a href="{{ route(config('product.routeNamePrefix').'products.edit',$product) }}" class="dropdown-item btn btn-block">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                <a href="{{ route(config('product.routeNamePrefix').'product.attributes.index',$product) }}" class="dropdown-item btn btn-block">
                                    <i class="fa fa-list"></i>
                                    Attributes
                                </a>
                                <button class="text-danger dropdown-item btn btn-block" wire:click="delete('{{$product->id}}')">
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
                <th colspan="8">
                    <h4 class="text-center">
                        No Products Found
                    </h4>
                </th>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $products->links() }}
    </div>

    @include('layouts.livewire.loading')
</div>