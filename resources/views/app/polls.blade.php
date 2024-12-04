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
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{ route('comments.show', ['poll' => $poll->slug]) }}">Voir les commentaires</a>
            @else
                <a href="{{ route('auth.login') }}">Se connecter pour voir les commentaires</a>
            @endif

            {{--                <form action="{{ route('app.vote', ['poll' => $poll->id]) }}" method="POST">--}}
            <form action="{{ route('app.result', ['poll' => $poll->slug]) }}">
                @csrf

                <!-- Boutons radio -->
                <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                <label for="intox-{{ $poll->id }}">Intox</label>

                <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                <label for="info-{{ $poll->id }}">Info</label>

                <!-- Bouton Valider -->
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>


        </div>
        <hr>
    @endforeach
@endsection
