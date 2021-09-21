@extends('layouts.master')

@section('page')

    <section>
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="card-body">
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h4 class="text-bold-700 mt-1 mb-25">${{ $totalSales }}</h4>
                    <p class="mb-0">Total Sale</p>
                </div>
            </div>
            <div class="card-content">
                <div id="subscribe-gain-chart"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4>Top 5 Products</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product SKU</th>
                                        <th># of Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostSoldProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->total_sales }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4>Most Viewed Products</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product SKU</th>
                                        <th># of Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostViewedProducts as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->view_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4>Last 5 Orders</h4>
                    <table class="table table-bordered">
                        <thead>
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Customer Name</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($lastFiveOrders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->shipping_name }}</td>
                                    <td> ${{ number_format($order->total, 2) }} </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4>Top 5 Customers</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topFiveCustoemrs as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->orders_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
