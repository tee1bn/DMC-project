<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountVerificationEmail extends Mailable
{


    use Queueable, SerializesModels;

    protected $email_to_verify  ;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_to_verify)
    {
        $this->email_to_verify = $email_to_verify;
  }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->from('Double@appitalcom')
                    ->view('email.email_template', ['email_to_verify'=> $this->email_to_verify]);
    }
}
