<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // store a new comment for a news item
    public function store(Request $request, $newsId)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $news = News::findOrFail($newsId);

        Comment::create([
            'news_id' => $news->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('news.show', $news->id)->with('success', 'Comment geplaatst.');
    }

    // delete a comment (owner or admin)
    public function destroy(Comment $comment)
    {
        $this->authorizeAction($comment);
        $newsId = $comment->news_id;
        $comment->delete();

        return redirect()->route('news.show', $newsId)->with('success', 'Comment verwijderd.');
    }

    private function authorizeAction(Comment $comment): void
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        if ($user->id !== $comment->user_id && !$user->isAdmin()) {
            abort(403);
        }
    }
}


