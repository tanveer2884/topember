<?php

namespace App\Mail;

use App\Models\AbondendCart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbandonedCartEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AbondendCart $abondendCart)
    {
        $this->cart = $abondendCart;
        $this->user = $abondendCart->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.abandoned-carts')
            ->to(
                $this->user->email,
                $this->user->name
            )
            ->subject('We noticed you left something...');
    }
}
