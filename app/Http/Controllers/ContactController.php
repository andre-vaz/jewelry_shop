<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // Show the contact form
    public function showForm()
    {
        return view('contact');
    }

    // Handle the form submission
    public function submit(Request $request)
    {
        // Validate the incoming form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

            // Send an email
        try {
            Mail::raw($validated['message'], function ($mail) use ($validated) {
                $mail->from(config('mail.from.address'), config('mail.from.name'))
                    ->to('s.andre.vaz@gmail.com')  // Replace with the recipient's email
                    ->subject('New Contact Form Submission');
            });

            return back()->with('success', 'Your message has been sent!');
        } catch (\Exception $e) {
            Log::error('Mail sending error: ' . $e->getMessage());
            return back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }
}
