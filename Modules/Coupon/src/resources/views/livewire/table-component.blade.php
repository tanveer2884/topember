<div>
    <table class="table table-hover table-responsive-md">
        <thead>
        <tr>
            <th colspan="7">
                <div class="row justify-content-end">
                    <div class="col-md-4 text-right">
                        <input type="search" placeholder="Search Coupon By Name/Code" class="form-control" wire:model.debounce.500ms="search">
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th>
                <a href="javascript:void(0);" class="btn py-0 pl-0"  wire:click="sort('name')">
                    Name
                    {!! $this->sortingInfo('name') !!}
                </a>
            </th>
            <th>
                Code
            </th>
            <th>
                Discount
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
        @foreach($coupons as $coupon)
            <tr>
                <td>
                    {{ $coupon->name }}
                </td>
                <td>
                    {{ $coupon->code }}
                </td>
                <td>
                    @if ($coupon->isDiscountPercent())
                        {{ $coupon->value }}%
                    @else
                        ${{ $coupon->value }}
                    @endif

                </td>
                <td>
                    @if ($coupon->isActive())
                        <i class="fa fa-circle text-success"></i>
                    @else
                        <i class="fa fa-circle text-danger"></i>
                    @endif
                </td>
                <td>
                    {{ $coupon->created_at->diffForHumans() }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">
                                <a href="{{ route(config('coupon.routeNamePrefix').'coupons.edit',$coupon) }}" class="dropdown-item btn btn-block">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                <button class="dropdown-item btn btn-block" wire:click="toggleStatus('{{$coupon->id}}')">
                                    <i class="fa fa-refresh"></i>
                                    Toggle Status
                                </button>
                                <button class="text-danger dropdown-item btn btn-block" wire:click="delete('{{$coupon->id}}')">
                                    <i class="fa fa-trash"></i>
                                    Delete
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
        {{ $coupons->links() }}
    </div>

    @include('layouts.livewire.loading')
</div>
