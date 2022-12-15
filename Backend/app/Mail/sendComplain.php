<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendComplain extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $sub;
    public $id;
    public $msg;
    public function __construct($sub,$id,$msg)
    {
        //
        $this->sub=$sub;
        $this->id=$id;
        $this->msg=$msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('CustomerView.sendComplainMail')->with('id',$this->id)
                                                    ->with('msg',$this->msg)
                                                    ->subject($this->sub);
        return back();
    }
}
