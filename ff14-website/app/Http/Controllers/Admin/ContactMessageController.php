<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormReplyMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    // list all messages
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contact.index', compact('messages'));
    }

    // show a single message
    public function show(ContactMessage $message)
    {
        return view('admin.contact.show', compact('message'));
    }

    // reply to message
    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $message->admin_reply = $request->input('admin_reply');
        $message->replied_at = now();
        $message->replied_by = Auth::id();
        $message->save();

        try {
            Mail::to($message->email)->send(new ContactFormReplyMail($message));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact reply email: ' . $e->getMessage());
        }

        return redirect()->route('admin.contact.show', $message)->with('success', 'Antwoord verzonden.');
    }
}


