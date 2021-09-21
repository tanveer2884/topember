<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Topdot\Order\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrackingNumberUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->queue = 'emails';
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tracking-updated')
            ->subject('Tracking Updated')
            ->to(
                $this->order->shipping_email,
                $this->order->shipping_name
            );;
    }
}
