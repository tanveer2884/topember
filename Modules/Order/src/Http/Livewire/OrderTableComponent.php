<?php

namespace Topdot\Order\Http\Livewire;

use Livewire\Component;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\WithUniqueId;
use Livewire\WithPagination;
use Topdot\Order\Models\Order;

class OrderTableComponent extends Component
{
    use WithUniqueId,
        WithPagination,
        HasSorting;

    public $search;
    protected $queryString = ['search','orderBy','sortOrder'];

    public function render()
    {
        return view('order::livewire.order-table-component',[
            'orders' => $this->getOrders()
        ]);
    }

    public function getOrders()
    {
        $orders = Order::query();

        if ( $this->search ){
            $orders->where('shipping_name','LIKE',"%{$this->search}%")
                ->orWhere('tracking_number','LIKE',"%{$this->search}%")
                ->orWhere('order_id','LIKE',"%{$this->search}%")
                ->orWhere('created_at','LIKE',"%{$this->search}%");
        }

        $orders->orderBy($this->orderBy,$this->sortOrder);
        return $orders->paginate(50);
    }
}
