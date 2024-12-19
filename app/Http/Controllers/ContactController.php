<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;

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
       Log::info('Contact form submission started.');
   
       try {
           // Validate the incoming form data
           $validated = $request->validate([
               'name' => 'required|string|max:255',
               'email' => 'required|email|max:255',
               'message' => 'required|string|min:10',
           ]);
   
           Log::info('Form data validated successfully.', $validated);
   
           // Send an email
           Mail::raw($validated['message'], function ($mail) use ($validated) {
               $mail->from(config('mail.from.address'), config('mail.from.name'))
                   ->to('s.andre.vaz@gmail.com')
                   ->subject('New Contact Form Submission');
           });
   
           Log::info('Mail sent successfully.');
   
           return back()->with('success', 'Your message has been sent!');
       } catch (ValidationException $e) {
           Log::error('Validation error: ' . json_encode($e->errors()));
           return back()->withErrors($e->errors());
       } catch (\Exception $e) {
           Log::error('Mail sending error: ' . $e->getMessage());
           return back()->with('error', 'Failed to send your message. Please try again later.');
       }
   }
}
