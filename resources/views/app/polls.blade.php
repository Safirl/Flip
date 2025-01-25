@extends('base')

@section('title', 'Votes du jour')
@vite(['resources/css/polls.css'])
@vite(['resources/js/polls.js'])

@section('content')
    <h1>
        @if($isFeed)
            Quotes de la semaine
        @else
            Quotes du jour
        @endif
    </h1>

    <div class="swiper pollsSwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <x-poll.card :poll="$poll"/>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
@endsection
