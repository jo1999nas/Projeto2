@extends('layouts.main')

@section('title', 'Criar Post')

@section('content')

<h1>Crie um novo post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="caixa-posts-create">
        <label for="body">Conteúdo:</label>
        <textarea name="body" id="body" placeholder="Escreva seu post aqui..."></textarea>
        <button type="submit">Publicar</button>
    </div>

@endsection