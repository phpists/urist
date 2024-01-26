<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeedbackFormMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $message
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новий відгук форми "Опитування"',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.feedback-form',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
