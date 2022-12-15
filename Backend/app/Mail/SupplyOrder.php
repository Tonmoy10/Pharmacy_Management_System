<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplyOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $body;
    public $id;
    public $order=[];
    public function __construct($sub,$body,$id,$order)
    {
        $this->sub;
        $this->body=$body;
        $this->id=$id;
        $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ManagerView.MailTemp')
        ->subject($this->sub)
        ->with('body',$this->body)
        ->with('id',$this->id)
        ->with(['order',$this->order]);
    }
}
