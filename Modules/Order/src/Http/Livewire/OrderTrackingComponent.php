<?php

namespace Topdot\Order\Http\Livewire;

use Livewire\Component;
use Topdot\Order\Models\Order;
use App\Mail\TrackingNumberUpdated;
use Illuminate\Support\Facades\Mail;

class OrderTrackingComponent extends Component
{
    public Order $order;

    public $tracking;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->tracking = $order->tracking_number;
    }

    public function render()
    {
        return view('order::livewire.order-tracking-component',[
            'tracking' => $this->tracking
        ]);
    }

    public function submit()
    {
        $this->order->update([
            'tracking_number' => $this->tracking
        ]);

        if ( $this->tracking ){
            Mail::send(new TrackingNumberUpdated($this->order));
        }
        $this->emit('alert-success','Tracking number updated');
    }
}
