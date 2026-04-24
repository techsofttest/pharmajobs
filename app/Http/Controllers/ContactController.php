<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to(env('ADMIN_EMAIL', 'techsofttest@gmail.com'))
                ->send(new \App\Mail\ContactFormMail($validated));

            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact form mail error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'There was an issue sending your message. Please try again later.');
        }
    }
}
