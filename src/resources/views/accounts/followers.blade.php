@extends('layouts.main')

@section('title', 'Seguidores de ' . $account->name)

@section('content')

<h1>Seguidores de {{ $account->name }}</h1>

<ul class="followers-list">
    @foreach ($account->followers as $follower)
        <li class="follower-item">
            <a href="{{ route('account.show', $follower->name) }}">{{ $follower->name }}</a>
        </li>
    @endforeach
</ul>

@endsection