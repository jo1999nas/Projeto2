<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load(['account', 'comments.account']);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string|min:3|max:2500',
        ]);

        $post = auth()->user()->account->posts()->create($validated);

        return redirect()->route('posts.show', $post);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        // Verificamos se o usuário tem permissão para atualizar o post na PostPolicy
        $this->authorize('update', $post);

        $validated = $request->validate([
            'body' => 'required|string|min:3|max:2500',
        ]);

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy(Post $post) : RedirectResponse
    {
        // Verificamos se o usuário tem permissão para apagar o post na PostPolicy
        $this->authorize('delete', $post);
    
        // Apagar o post do banco de dados
        $post->delete();
        
        // Redirecionar
        return redirect()->route('feed.index')->with('success', 'Post excluído com sucesso!');
    }
}