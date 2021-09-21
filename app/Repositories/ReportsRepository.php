<?php

namespace App\Repositories;

use App\Models\User;
use Topdot\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Topdot\Product\Models\Product;

class ReportsRepository
{
    public function getTotalRevenue()
    {
        return Order::query()->completed()->sum('total');
    }

    public function getMostSoldProducts()
    {
        return Product::query()
            ->select('products.*')
            ->addSelect(DB::raw('SUM(order_product.qty) as total_sales'))
            ->join('order_product', function ($query) {
                $query->on('order_product.product_id', 'products.id');
            })
            ->join('orders', function ($query) {
                $query->on('order_product.order_id', 'orders.id');
            })
            ->groupBy('products.id')
            ->orderBy('total_sales', 'DESC')
            ->limit(5)
            ->get();
    }

    public function getMostViewedProducts()
    {
        return Product::query()->orderBy('view_count', 'DESC')->limit(5)->get();
    }

    public function getLastFiveOrders()
    {
        return Order::query()->latest()->limit(5)->get();
    }

    public function getTopFiveCustomers()
    {
        return User::query()
            ->whereHas('orders', function($query){
                $query->completed();
            })
            ->withCount(['orders' => function ($query) {
                return $query->completed();
            }])
            ->orderBy('orders_count', 'DESC')
            ->limit(5)
            ->get();
    }
}
