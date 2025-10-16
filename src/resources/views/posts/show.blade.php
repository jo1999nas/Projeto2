@extends('layouts.main')

@section('title', 'Post de ' . $post->account->user->name)

@section('content')

<main>
    <div class="post">
        <p class="post-body">{{ $post->body }}</p>
        <p class="post-info">
            Postado por <strong><a href="/{{ $post->account->name }}">{{ $post->account->user->name }}</a></strong> em {{ $post->created_at->format('d/m/Y') }}
        </p>
    </div>

    @auth
        @if (auth()->user()->account->id === $post->account_id)

            <form action="{{ route('posts.edit', $post) }}" method="GET" style="display:inline;">
                <button type="submit" class="btn btn-secondary">Editar post</button>
            </form>

            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir post</button>
            </form>
        @endif
    @endauth

    <h2>Comentários</h2>
    <form action="{{ route('comments.store', $post) }}" method="POST">
        @csrf
        <div class="comment-box">
            <label for="comment">Deixe seu comentário:</label><br>
            <textarea name="comment" id="comment" rows="4" cols="50" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar comentário</button>
    </form>

    @if($post->comments->isNotEmpty())
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p class="comment-body">{{ $comment->comment }}</p>
                <p class="comment-info">
                    <strong><a href="#">{{ $comment->account->user->name }}</a></strong>
                    em {{ $comment->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
            @auth
                @if (auth()->user()->account->id === $comment->account_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir comentário</button>
                    </form>
                @endif
            @endauth
        @endforeach
    @else
    <div>
        <p class="alert">Seja o primeiro a comentar!</p>
    </div>
    @endif

    <a href="{{ route('feed.index') }}">Voltar para o feed</a>
</main>

@endsection