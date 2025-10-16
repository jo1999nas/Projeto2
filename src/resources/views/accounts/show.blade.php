@extends('layouts.main')

@section('title', 'Página Inicial')

@section('content')

<body>
    <h1 class="profile-title">Perfil de: {{ $account->name }}</h1>
    <p class="profile-owner">
        <strong>{{ $account->user->name }}</strong>
    </p>

    <div class="profile-stats">
        <span><strong>{{ $account->posts->count() }}</strong> posts</span> | 
        <span><strong>{{ $account->followers->count() }}</strong> <a href="{{ route('accounts.followers', $account->name) }}">seguidores</a></span> | 
        <span><strong>{{ $account->following->count() }}</strong> <a href="{{ route('accounts.following', $account->name) }}">seguindo</a></span>

        {{-- Verifica se o usuário está logado e não está no próprio perfil --}}
        @if(auth()->check() && auth()->user()->account->id !== $account->id)

            {{-- CORREÇÃO: Pega a CONTA do usuário logado, acessa a relação 'following' 
                e verifica se ela CONTÉM a CONTA do perfil atual. --}}
            @if(auth()->user()->account->following->contains($account))
                
                {{-- Se já segue, mostra o botão DEIXAR DE SEGUIR --}}
                <form action="{{ route('accounts.unfollow', $account->name) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deixar de seguir</button>
                </form>
            @else

                {{-- Se não segue, mostra o botão SEGUIR --}}
                <form action="{{ route('accounts.follow', $account->name) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Seguir</button>
                </form>
            @endif
        @endif
    </div>
    
    <hr>

    <h2 class="profile-posts-title">Posts</h2>

    
    @forelse ($account->posts as $post)
        <ul class="posts-list">
            <li class="post-item">
                <div class="post">
                    <p class="post-body">{{ $post->body }}</p>
                    <a href="/posts/{{ $post->id }}" class="read-more">Leia mais...</a>
                    <small class="post-info">Postado em: {{ $post->created_at->diffForHumans() }}</small>                    
                </div>
            </li>
        </ul>
   
    @empty
        <div class="no-posts">
            <p class="alert">Este usuário ainda não fez nenhum post.</p>
        </div>
    @endforelse
</body>

@endsection