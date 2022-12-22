<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $passwordOg;

    public function __construct($nameTo,$email,$passwordOg)
    {
        $this->name = $nameTo;
        $this->email = $email;
        $this->passwordOg = $passwordOg;
    }

    public function build()
    {

        return $this->view('regMail')
            ->subject('Welcome '.$this->name.'!')
            ->from('infostudconnect@infostud.com', 'Infostud Connect');
    }
}
