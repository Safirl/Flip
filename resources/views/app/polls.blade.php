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

            @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
            (auth()->check() && \App\Models\UserPoll::where('user_id', auth()->id())->where('poll_id', $poll->id)->exists()))
                <a href="{{ route('app.result', ['poll' => $poll->slug]) }}">Lire la suite</a>
            @else
                <form action="{{ route('app.result', ['poll' => $poll->slug]) }}">
                    @csrf
                    <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                    <label for="intox-{{ $poll->id }}">Intox</label>

                <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                <label for="info-{{ $poll->id }}">Info</label>

                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            @endif
        </div>
        <hr>
    @endforeach
    <x-nav-bar/>
@endsection
