<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstname;
    public $secondname;
    public $email;
    public $subject;
    public $msg;
    
    public function __construct($firstname, $secondname, $email,$subject,$msg)
    {
        $this->firstname = $firstname;
        $this->secondname = $secondname;
        $this->email = $email;
        $this->subject = $subject;
        $this->msg = $msg;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->markdown('emails.contact');
    }
}
