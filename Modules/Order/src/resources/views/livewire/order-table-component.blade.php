<div>
    <table class="table table-hover table-responsive-md">
        <thead>
            <tr>
                <th colspan="7">
                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <input type="search" placeholder="Search Order By Name/Code" class="form-control" wire:model.debounce.500ms="search">
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>
                    Name
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
            @forelse($orders as $order)
            <tr>
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
                <td>
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
                    <td colspan="6" class="text-center">
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