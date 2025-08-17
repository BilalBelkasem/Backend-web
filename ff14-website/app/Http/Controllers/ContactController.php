<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show contact form
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        // bericht opslaan in database
        ContactMessage::create($request->all());

        // email sturen naar admin
        try {
            Mail::to(config('mail.admin_address', 'admin@ff14-website.com'))->send(new ContactFormMail($request->all()));
        } catch (\Exception $e) {
            // Log error maar laat het formulier wel door gaan
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        return redirect()->route('contact.index')->with('success', 'Bericht succesvol verzonden! We nemen zo snel mogelijk contact met je op.');
    }
}
