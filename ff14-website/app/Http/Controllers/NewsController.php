<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // toon alle nieuws
    public function index()
    {
        $news = News::with('user')->latest('published_at')->paginate(10);
        return view('news.index', compact('news'));
    }

    // formulier voor nieuw nieuws
    public function create()
    {
        return view('news.create');
    }

    // nieuw nieuws opslaan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['published_at'] = $data['published_at'] ?? now();

        // afbeelding uploaden
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $data['image'] = $path;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Nieuws succesvol aangemaakt!');
    }

    // toon specifiek nieuws
    public function show(string $id)
    {
        $news = News::with(['user', 'comments.user'])->findOrFail($id);
        return view('news.show', compact('news'));
    }

    // formulier voor bewerken
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date'
        ]);

        $news = News::findOrFail($id);
        $data = $request->all();

        // nieuwe afbeelding uploaden
        if ($request->hasFile('image')) {
            // oude afbeelding verwijderen
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $path = $request->file('image')->store('news', 'public');
            $data['image'] = $path;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Nieuws succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        
        // afbeelding verwijderen
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Nieuws succesvol verwijderd!');
    }
}
