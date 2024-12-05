
@extends('base')

@section('title', 'Votes du jour')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/polls.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection

@section('content')
    <h1 style="padding: 1.5rem 1.5rem 0;">Votes du jour</h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide">
                    <h2>{{ $poll->title }}</h2>
                    <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
                    <p><strong>Author:</strong> {{ $poll->author }}</p>
                    <p><strong>Context:</strong> {{ $poll->context }}</p>
                    <p><strong>Analysis:</strong> {{ $poll->analysis }}</p>
                    <p><strong>Slug:</strong> {{ $poll->slug }}</p>

            @if (
                (session()->has('completed_polls') && in_array($poll->id, session('completed_polls'))) ||
                auth()->check() && $poll->isVoteVerification
                )
                <a href="{{ route('app.result', ['poll' => $poll->slug]) }}">Lire la suite</a>
            @else
                <form action="{{ route('app.result', ['poll' => $poll->slug]) }}" method="POST">
                    @csrf
                    <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false" required>
                    <label for="intox-{{ $poll->id }}">Intox</label>

                    <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true" required>
                    <label for="info-{{ $poll->id }}">Info</label>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            @endif
                </div>
            @endforeach
    </div>

    <x-nav-bar/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "cards",
            grabCursor: true,
        });
    </script>

@endsection
@section('scripts')
@endsection
