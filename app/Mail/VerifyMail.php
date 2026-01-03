<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $verificationUrl;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->verificationUrl = route('verification.notice', [
            'token' => $user->email_verification_token,
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email Address'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.verify-mail',
            with: [
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
