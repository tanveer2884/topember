<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Topdot\Order\Models\Order;
use Illuminate\Queue\SerializesModels;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $toAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $toAdmin=false)
    {
        $this->queue = 'emails';
        $this->order = $order;
        $this->toAdmin = $toAdmin;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('emails.order-created');

        if ($this->toAdmin) {
            return $email->to(
                getGeneralSetting('store_contact_email',config('bt.emails.default.address')),
                config('bt.emails.default.name')
            )
            ->subject("New Order #{$this->order->order_id}");
        }

        return $email->to(
            $this->order->shipping_email,
            $this->order->shipping_name
        )->subject("Invoice for order #{$this->order->order_id}");
    }
}
