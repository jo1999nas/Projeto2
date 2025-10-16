<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) : RedirectResponse
    {
        $validated = $request->validate([
            'comment' => 'required|string|min:3|max:2500',
        ]);

        $post->comments()->create([
            'comment' => $validated['comment'],
            'account_id' => auth()->user()->account->id,
        ]);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Comment $comment) : RedirectResponse
    {
        // Verificamos se o usuário tem permissão para apagar o comentário na CommentPolicy
        $this->authorize('delete', $comment);
    
        // Apagar o comentário do banco de dados
        $comment->delete();
    
        return back()->with('success', 'Comentário apagado com sucesso!');

    }
}
