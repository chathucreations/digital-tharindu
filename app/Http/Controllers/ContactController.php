<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use App\Rules\SriLankanPhone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', new SriLankanPhone()],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $message = ContactMessage::create($data);

        try {
            $recipient = setting('contact_email') ?: config('mail.from.address');

            if ($recipient) {
                Mail::to($recipient)->send(new ContactMessageMail($message));
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('status', 'Thank you for reaching out. We will get back to you shortly.');
    }
}
