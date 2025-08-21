<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateMessageController extends Controller
{
    public function inbox()
    {
        $user = Auth::user();
        $messages = PrivateMessage::with(['sender', 'receiver'])
            ->where('receiver_id', $user->id)
            ->latest()
            ->paginate(20);
        return view('messages.inbox', compact('messages'));
    }

    public function store(Request $request, $username)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $receiver = User::where('username', $username)->firstOrFail();

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('profile.public', $username)->with('success', 'Privébericht verzonden.');
    }

    public function markRead(PrivateMessage $message)
    {
        $user = Auth::user();
        if ($message->receiver_id !== $user->id) abort(403);
        $message->update(['read_at' => now()]);
        return back();
    }
}


