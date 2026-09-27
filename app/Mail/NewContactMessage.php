<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public Message $contactMessage;
    public ?SiteSetting $siteSetting;

    public function __construct(Message $message)
    {
        $this->contactMessage = $message;
        $this->siteSetting = SiteSetting::first();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Message: ' . $this->contactMessage->subject,
            replyTo: [
                $this->contactMessage->email,
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-contact-message',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

