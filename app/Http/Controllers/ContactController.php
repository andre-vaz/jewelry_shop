<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactConfirmationMail;
use App\Mail\ContactMessage;
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

        // Send emails
        try {
            // Send confirmation email to the user
            Mail::to($validated['email'])->send(new ContactConfirmationMail($validated['name']));

            // Send notification email to the admin
            Mail::to('s.andre.vaz@gmail.com')->send(new ContactMessage($validated));

            Log::info('Mail sent successfully.');
            return back()->with('success', 'Your message has been sent!');
        } catch (\Exception $e) {
            Log::error('Mail sending error: ' . $e->getMessage());
            return back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }
}
