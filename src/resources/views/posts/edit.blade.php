@extends('layouts.main')

@section('title', 'Editar Post')

@section('content')

<h1>Edite seu post</h1>

<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="caixa-posts">
        <label for="body">Conteúdo:</label>
        <textarea name="body" id="body" placeholder="Escreva seu post aqui...">{{ $post->body }}</textarea>
        <button type="submit">Publicar</button>
    </div>

@endsection