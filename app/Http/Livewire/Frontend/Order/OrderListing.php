<?php

namespace App\Http\Livewire\Frontend\Order;

use Livewire\Component;
use Topdot\Order\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderListing extends Component
{
    public $search;

    public $listeners = [
        'search-orders' => 'setSearchQuery'
    ];

    public function render()
    {
        return view('livewire.frontend.order.order-listing',[
            'orders' => $this->getOrders()
        ]);
    }

    public function setSearchQuery($searchTerm)
    {
        $this->search = $searchTerm;
    }

    public function getOrders()
    {
        return Order::query()
            ->where('user_id',Auth::id())
            ->where(function($query){
                $query->where('order_id','LIKE',"%{$this->search}%");
                $query->orWhere('tracking_number','LIKE',"%{$this->search}%");
                $query->orWhere('status','LIKE',"%{$this->search}%");
            })
            ->latest()
            ->paginate(10);
    }
}
