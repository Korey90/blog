<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    // Wyświetla wszystkie komentarze dla danego posta
    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return redirect()->back()->with('success', 'Comment has been posted');
    }

    // Tworzy nowy komentarz
    public function store(Request $request, $postId)
    {

        $request->validate([
            'content' => 'required|min:5',
        ]);

        Comment::create([
            'content' => $request->input('content'),
            'post_id' => $postId,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Komentarz został dodany.');
    }

    // Edytuje istniejący komentarz
    public function update(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|min:5',
        ]);

        $comment = Comment::findOrFail($commentId);
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Komentarz został zaktualizowany.');
    }

    // Usuwa istniejący komentarz
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->back()->with('success', 'Komentarz został usunięty.');
    }
}
