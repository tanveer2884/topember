<?php

namespace App\Http\Livewire\Frontend\Order;

use Livewire\Component;

class OrderSearch extends Component
{
    public $search;

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.frontend.order.order-search');
    }

    public function searchOrders()
    {
        $this->emit('search-orders',$this->search);
    }
}
