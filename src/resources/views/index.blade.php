@extends('layouts.main')

@section('title', 'Página Inicial')

@section('content')

<main>
    {{-- Loop para exibir cada post recebido do controller --}}
    @forelse ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>

            {{-- Informações adicionais como autor e data --}}
            <p class="post-info">
                Postado por <strong>{{ $post->account->user->name }}</strong> em {{ $post->created_at->format('d/m/Y') }}
            </p>

            {{-- Corpo do post. Usamos !! !! para renderizar HTML, se houver. Cuidado com XSS. --}}
            {{-- Se o corpo do post for apenas texto, use {{ $post->body }} --}}
            <p>{{ Str::limit($post->body, 200) }}</p>
            <a href="#">Leia mais...</a>
        </div>
    @empty
        {{-- Mensagem que aparece se a variável $posts estiver vazia --}}
        <div class="post">
            <h2>Nenhum post encontrado!</h2>
            <p>Ainda não há nada por aqui. Volte em breve para conferir as novidades!</p>
        </div>
    @endforelse

    {{-- Links de paginação do Laravel --}}
    <div class="pagination-wrapper">
        {{ $posts->links() }}
    </div>
</main>

@endsection