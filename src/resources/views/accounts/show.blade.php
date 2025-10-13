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