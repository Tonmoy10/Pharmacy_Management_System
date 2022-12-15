<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptContract extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $contract_id;
    public $contract_status;
    public function __construct($sub,$contract_id,$contract_status)
    {
        //
        $this->sub;
        $this->contract_id=$contract_id;
        $this->contract_status=$contract_status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.mailcontract')->subject($this->sub)
                                                ->with("contract_id",$this->contract_id)
                                                ->with("contract_status",$this->contract_status);
    }
}
