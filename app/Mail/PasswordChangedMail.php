<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function envelope(): Envelope {
    return new Envelope(
        subject: 'Tu contraseña ha sido actualizada - Sabi Núcleo Médico',
    );
}

public function content(): Content {
    return new Content(
        view: 'emails.password-changed',
    );
}
}
