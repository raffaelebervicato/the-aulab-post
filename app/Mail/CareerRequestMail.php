<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $user,
        public string $role,
        public string $messageTxt = ''
    ) {}

    public function build()
    {
        return $this->subject('Nuova richiesta ruolo: '.$this->role)
                    ->view('mail.career-request');
    }
}
