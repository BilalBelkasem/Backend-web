<?php

namespace App\Http\Controllers;

use App\Models\ProfilePost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePostController extends Controller
{
    public function store(Request $request, $username)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $profileUser = User::where('username', $username)->firstOrFail();

        ProfilePost::create([
            'profile_user_id' => $profileUser->id,
            'author_user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('profile.public', $username)->with('success', 'Bericht geplaatst.');
    }

    public function destroy(ProfilePost $post)
    {
        $user = Auth::user();
        if (!$user) abort(403);
        if ($user->id !== $post->author_user_id && $user->id !== $post->profile_user_id && !$user->isAdmin()) {
            abort(403);
        }
        $username = optional($post->profileUser)->username ?? optional($post->profileUser)->name;
        $post->delete();
        return back()->with('success', 'Bericht verwijderd.');
    }
}


