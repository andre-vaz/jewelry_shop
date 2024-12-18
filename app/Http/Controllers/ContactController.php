<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Here you can handle the form data (e.g., save to DB, send email)
        // For now, we'll just return a success message

        // Optionally, send an email (if you want to integrate it later)
        // Mail::to(config('mail.contact_email'))->send(new ContactMessage($validated));

        return back()->with('success', 'Your message has been sent!');
    }
}
