<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $datatomail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datatomail)
    {
        $this->datatomail = $datatomail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datatomail = $this->datatomail;
        $this->subject('Requested to reset your password - '.env('APP_NAME'))
                ->view('mail.forgot',compact('datatomail'));
    }
}
