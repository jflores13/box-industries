<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{first_name:string,last_name:string,email:string,company:string,message:string,lang:string}  $payload
     */
    public function __construct(public array $payload) {}

    public function envelope(): Envelope
    {
        $fullName = trim(($this->payload['first_name'] ?? '').' '.($this->payload['last_name'] ?? ''));

        return new Envelope(
            subject: 'New contact form submission - '.$fullName,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_form_submitted',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
