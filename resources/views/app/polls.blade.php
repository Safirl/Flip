@extends('base')


@section('title', 'Votes du jour')

@section('content')
    <h1> Votes du jour </h1>

    @foreach ($polls as $poll)
        <div class="poll">
            <h2>{{ $poll->title }}</h2>
            <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
            <p><strong>Author:</strong> {{ $poll->author }}</p>
            <p><strong>Context:</strong> {{ $poll->context }}</p>
            <p><strong>Analysis:</strong> {{ $poll->analysis }}</p>
            <p><strong>Slug:</strong> {{ $poll->slug }}</p>

            <a href="{{ route('app.result', ['poll' => $poll->slug]) }}">Lire la suite</a>
        </div>
        <hr>
    @endforeach
@endsection
