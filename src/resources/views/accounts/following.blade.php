@extends('layouts.main')

@section('title', 'Quem ' . $account->name . ' está seguindo')

@section('content')

<h1>Quem {{ $account->name }} está seguindo</h1>
@if ($account->following->isEmpty())
    <div class="no-following">
        <p class="alert">Esta conta não está seguindo ninguém.</p>
    </div>
@else
<ul class="following-list">
    @foreach ($account->following as $followed)
        <li class="following-item">
            <a href="{{ route('account.show', $followed->name) }}">{{ $followed->name }}</a>
        </li>
    @endforeach
</ul>
@endif

<a href="{{ route('account.show', $account->name) }}" class="back-link">Voltar para o perfil de {{ $account->name }}</a>

@endsection