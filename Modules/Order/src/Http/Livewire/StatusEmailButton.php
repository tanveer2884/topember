<?php

namespace Topdot\Order\Http\Livewire;

use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class StatusEmailButton extends Component
{
    public $order;

    public function mount($order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('order::livewire.status-email-button');
    }

    public function sendStatusEmail()
    {
        Mail::send(new OrderStatusUpdated($this->order));
        $this->emit('alert-success','Email sent successfully');
    }
}
