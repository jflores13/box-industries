<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Address;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        $toAddress = config('mail.to.address') ?: config('mail.from.address');
        $toName = config('mail.to.name') ?: config('mail.from.name');

        $toAddress = is_string($toAddress) ? trim($toAddress) : '';
        $toName = is_string($toName) ? trim($toName) : '';

        if (! filter_var((string) $toAddress, FILTER_VALIDATE_EMAIL)) {
            $toAddress = config('mail.from.address');
            $toName = config('mail.from.name');
        }

        $recipient = $toName !== '' ? new Address($toAddress, $toName) : new Address($toAddress);

        Mail::to($recipient)
            ->send(new ContactFormSubmitted($data));

        return back()->with('success', 1);
    }
}
