@extends('layouts.main')

@section('title', 'Página Inicial')

@section('content')

<body>
    <h1>Perfil de: {{ $account->name }}</h1>
    <p>
        <strong>{{ $account->user->name }}</strong>
    </p>

    <div>
        <span><strong>{{ $account->posts->count() }}</strong> posts</span> | 
        <span><strong>{{ $account->followers->count() }}</strong> seguidores</span> | 
        <span><strong>{{ $account->following->count() }}</strong> seguindo</span>
    </div>
    
    <hr>

    <h2>Posts</h2>

    @forelse ($account->posts as $post)
        <div class="post">
            <p>{{ $post->body }}</p>
            <small>Postado em: {{ $post->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p>Esta conta ainda não tem nenhum post.</p>
    @endforelse
</body>

@endsection