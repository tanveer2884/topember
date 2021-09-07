<div class="order-table table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th width="20%">Date</th>
        <th width="20%">Order#</th>
        <th width="20%">Tracking#</th>
        <th width="30%">Price</th>
        <th class="text-center" width="15%">Status</th>
        <th class="text-center" width="15%">Detail</th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $order)
        <tr>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->tracking_number }}</td>
            <td>${{ number_format($order->total,2) }}</td>
            <td class="text-center">{{ $order->status }}</td>
            <td class="text-center">
                <a href="{{ route('user.orders.show',$order) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24.877" height="24.877" viewBox="0 0 24.877 24.877"><path d="M23.687,0H1.19A1.19,1.19,0,0,0,0,1.19v22.5a1.192,1.192,0,0,0,1.19,1.191h22.5a1.191,1.191,0,0,0,1.19-1.191V1.191A1.191,1.191,0,0,0,23.687,0ZM7.178,20.794H3.887V17.5h3.29v3.291Zm0-6.349H3.887V11.154h3.29v3.291Zm0-6.35H3.887V4.805h3.29V8.1Zm11.7,11.847H10a.794.794,0,1,1,0-1.587h8.876a.794.794,0,1,1,0,1.587Zm0-6.349H10a.794.794,0,1,1,0-1.587h8.876a.794.794,0,1,1,0,1.587Zm.478-6.35H10.475a.794.794,0,0,1,0-1.587h8.876a.794.794,0,1,1,0,1.587Z" fill="#c8c8c8"/></svg>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">
                No result found.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
    @include('layouts.livewire.loading')
</div>

<div class="order-breadcrumb div-flex">
    {{ $orders->links() }}
</div>

