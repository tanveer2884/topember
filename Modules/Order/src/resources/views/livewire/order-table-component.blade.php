<div>
    <div class="row">
        <div class="col-md-6">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <label for="">From</label>
                    <input type="date" placeholder="From" class="form-control" wire:model.debounce.500ms="from">
                </div>
                <div class="col-md-6">
                    <label for="">To</label>
                    <input type="date" placeholder="To" class="form-control" wire:model.debounce.500ms="to">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row justify-content-end align-items-end">
                <div class="col-md-8">
                    <label for="">Search</label>
                    <input type="search" placeholder="Search Order By Name/Code" class="form-control" wire:model.debounce.500ms="search">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" wire:click="clear">
                        <i class="fa fa-times"></i>
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-hover table-responsive-md">
        <thead>
            <tr>
                <th>
                    Order No.
                </th>
                <th>
                    <div class="cursor-pointer" wire:click="sort('shipping_name')">
                        Name
                        {!! $this->sortingInfo('shipping_name') !!}
                    </div>
                </th>
                <th>
                    Tracking #
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Status
                </th>
                <th>
                    <div class="cursor-pointer" wire:click="sort('created_at')">
                        Created At
                        {!! $this->sortingInfo('created_at') !!}
                    </div>
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="white-space: nowrap;">
                    {{ $order->order_id }}
                </td>
                <td>
                    {{ $order->shipping_name }}
                </td>
                <td>
                    <livewire:order::order-tracking-component :order="$order" wire:key="{{ $this->getUniqueKey('tracking') }}" />
                </td>
                <td>
                    ${{ $order->total }}
                </td>
                <td>
                    @if ($order->isNew())
                    New
                    @elseif($order->isProcessing())
                    Processing
                    @else
                    Completed
                    @endif
                </td>
                <td class="text-center">
                    {{ $order->created_at->diffForHumans() }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">

                                <a href="{{ route(config('order.routeNamePrefix').'orders.show',$order) }}" class="text-primay dropdown-item btn btn-block">
                                    <i class="fa fa-tye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No result found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $orders->links() }}
    </div>

    @include('layouts.livewire.loading')
</div>

@push('js')

<script>
    $(document).ready(function() {
        $('body').on('click', '.editOnFocus p', function() {
            $(this).hide();
            $(this).closest('.editOnFocus').find('.input').show();
        })
        
        $('body').on('click', '.cancel-edit', function() {
            let editoronfocus = $(this).parent().parent();
            editoronfocus.find('p').show();
            editoronfocus.find('.input').hide();
        })
    })
</script>

@endpush