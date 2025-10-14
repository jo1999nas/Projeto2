@extends('layouts.main')

@section('title', 'Posts')

@section('content')

<h1>{{ $post->account->user->name }} - {{ $post->created_at->format('d/m/Y H:i') }}</h1>
<h3>{{ $post->body }}</h3>

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

<a href="{{ route('feed.index') }}">Voltar para o feed</a>

@endsection