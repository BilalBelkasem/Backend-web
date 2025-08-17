<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // toon alle gebruikers
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // formulier voor nieuwe gebruiker
    public function create()
    {
        return view('admin.users.create');
    }

    // nieuwe gebruiker opslaan
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol aangemaakt.');
    }

    // gebruiker tot admin maken
    public function promote(User $user)
    {
        $user->update(['is_admin' => true]);
        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol gepromoveerd tot admin.');
    }

    // admin rechten afnemen
    public function demote(User $user)
    {
        $user->update(['is_admin' => false]);
        return redirect()->route('admin.users.index')
            ->with('success', 'Admin rechten succesvol ingetrokken.');
    }
}
