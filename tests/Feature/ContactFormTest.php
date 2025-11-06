<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_form_sends_email(): void
    {
        Mail::fake();

        $payload = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'company' => 'Acme',
            'message' => 'Hello!',
            'lang' => 'en',
        ];

        $response = $this->post('/en/contact', $payload);

        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormSubmitted::class, function ($mailable) use ($payload) {
            return $mailable->payload['email'] === $payload['email'];
        });
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post('/en/contact', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'email',
            'company',
            'message',
            'lang',
        ]);
    }
}
