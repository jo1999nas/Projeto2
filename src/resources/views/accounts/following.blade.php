@extends('layouts.main')

@section('title', 'Quem ' . $account->name . ' está seguindo')

@section('content')

<h1>Quem {{ $account->name }} está seguindo</h1>

<ul class="following-list">
    @foreach ($account->following as $followed)
        <li class="following-item">
            <a href="{{ route('account.show', $followed->name) }}">{{ $followed->name }}</a>
        </li>
    @endforeach
</ul>

@endsection