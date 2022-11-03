<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sentDataOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sentDataOrder)
    {
        $this->sentDataOrder = $sentDataOrder;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bạn đã đặt hàng thành công đơn hàng tại HungBakery')->replyTo('duyhungngo506@gmail.com', 'Hung Bakery')
        ->view('emails.interfaceEmailOrder',['sentDataOrder' => $this->sentDataOrder]);
    }
}