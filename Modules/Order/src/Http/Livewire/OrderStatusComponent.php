<?php

namespace Topdot\Order\Http\Livewire;

use Livewire\Component;
use Topdot\Order\Models\Order;

class OrderStatusComponent extends Component
{
    public $order;
    public $status;

    public $statuses = [
        Order::STATUS_NEW => 'New',
        Order::STATUS_PROCESSING => 'Processing',
        Order::STATUS_COMPLETED => 'Completed'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function render()
    {
        return view('order::livewire.order-status-component');
    }

    public function updatedStatus()
    {
        $this->order->update([
            'status' => $this->status
        ]);

        $this->emit('alert-success','Status Updated Successfully');
    }
}
