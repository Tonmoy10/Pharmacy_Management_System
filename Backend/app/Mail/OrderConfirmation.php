<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $order_num;
    public $u_id;
    public $u_name;

    public function __construct($sub,$order_num,$u_name,$u_id)
    {
        //
        $this->sub;
        $this->order_num=$order_num;
        $this->u_id=$u_id;
        $this->u_name=$u_name;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('CustomerView.confirmOrder_Mail')->with('order_num',$this->order_num)
                                                            ->with('u_name',$this->u_name)
                                                            ->with('u_id',$this->u_id)
                                                            ->subject($this->sub);
    }
}
