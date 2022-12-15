<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $email;
    public $OTPCode;
    public function __construct($sub,$email,$OTPCode)
    {
        //
        $this->sub=$sub;
        $this->email=$email;
        $this->OTPCode=$OTPCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('AllUserView.OTPEmail')->subject($this->sub)
                                                ->with('email',$this->email)
                                                ->with('OTPCode',$this->OTPCode);
    }
}
