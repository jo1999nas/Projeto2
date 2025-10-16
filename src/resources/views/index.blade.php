@extends('layouts.main')

@section('title', 'Página Inicial')

@section('content')

<main>
    @if($posts->isNotEmpty())
        @foreach ($posts as $post)
            <div class="post">
                <p class="post-body">{{ Str::limit($post->body, 200) }}</p>
                <p class="post-info">
                    Postado por <strong><a href="/{{ $post->account->name }}">{{ $post->account->user->name }}</a></strong> em {{ $post->created_at->format('d/m/Y') }}
                </p>
                <a href="/posts/{{ $post->id }}" class="read-more">Leia mais...</a>
            </div>
        @endforeach
    @else
        <div>
            <p class='alert'>Ainda não há nada por aqui. Volte em breve para conferir as novidades!</p> 
        </div>        
    @endif

    <div class="pagination-wrapper">
        {{ $posts->links() }}
    </div>
</main>

@endsection