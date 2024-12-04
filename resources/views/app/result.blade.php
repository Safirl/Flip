@extends('base')


@section('title', 'Result')

@section('content')
    <h2>{{ $poll->title }}</h2>
    <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
    <p><strong>Author:</strong> {{ $poll->author }}</p>
    <p><strong>Context:</strong> {{ $poll->context }}</p>
    <p><strong>Analysis:</strong> {{ $poll->analysis }}</p>
    <p><strong>Slug:</strong> {{ $poll->slug }}</p>

    <p><strong>Your answer:</strong> {{ $answer == 1 ? 'Info' : 'Intox' }}</p>

@endsection
