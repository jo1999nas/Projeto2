@extends('layouts.main')

@section('title', 'Seguidores de ' . $account->name)

@section('content')

<h1>Seguidores de {{ $account->name }}</h1>
@if ($account->followers->isEmpty())
    <div class="no-followers">
        <p class="alert">Esta conta não possui seguidores.</p>
    </div>
@else
<ul class="followers-list">
    @foreach ($account->followers as $follower)
        <li class="follower-item">
            <a href="{{ route('account.show', $follower->name) }}">{{ $follower->name }}</a>
        </li>
    @endforeach
</ul>
@endif

<a href="{{ route('account.show', $account->name) }}" class="back-link">Voltar para o perfil de {{ $account->name }}</a>

@endsection