<?php

namespace Topdot\Order\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\WithUniqueId;

class OrderTableComponent extends Component
{
    use WithUniqueId,
        WithPagination,
        HasSorting;

    public $search;
    public $from;
    public $to;

    protected $queryString = ['search', 'from', 'to', 'orderBy', 'sortOrder'];

    public function render()
    {
        return view('order::livewire.order-table-component', [
            'orders' => $this->getOrders()
        ]);
    }

    public function getOrders()
    {
        $orders = Order::query();

        if ($this->search) {
            $orders->where(function ($query) {
                $query->where('shipping_name', 'LIKE', "%{$this->search}%")
                    ->orWhere('tracking_number', 'LIKE', "%{$this->search}%")
                    ->orWhere('order_id', 'LIKE', "%{$this->search}%")
                    ->orWhere('created_at', 'LIKE', "%{$this->search}%");
            });
        }

        if ($this->from) {
            $orders->where(DB::raw(' DATE(created_at)'), '>=', $this->from);
        }

        if ($this->to) {
            $orders->where(DB::raw(' DATE(created_at)'), '<=', $this->to);
        }

        $orders->orderBy($this->orderBy, $this->sortOrder);
        return $orders->paginate(50);
    }

    public function clear()
    {
        $this->search = null;
        $this->from = null;
        $this->to = null;
    }
}
