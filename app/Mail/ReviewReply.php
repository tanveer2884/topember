<?php

namespace App\Mail;

use App\Models\ProductReview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewReply extends Mailable
{
    use Queueable, SerializesModels;

    public ProductReview $review;
    public $reviewSubject;
    public $reviewMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ProductReview $review, $reviewSubject, $reviewMessage)
    {
        $this->review = $review;
        $this->reviewSubject = $reviewSubject;
        $this->reviewMessage = $reviewMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.review-reply')
            ->to( $this->review->email, $this->review->name )
            ->subject($this->reviewSubject);
    }
}
