@extends('base')

@section('title', 'Votes du jour')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/polls.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swiper/8.4.4/swiper-bundle.min.css">
@endsection

@section('content')

    <h1> Votes du jour </h1>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide items-card">
                    <div class="poll">
                        <h2>{{ $poll->title }}</h2>
                        <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
                        <p><strong>Author:</strong> {{ $poll->author }}</p>
                        <p><strong>Context:</strong> {{ $poll->context }}</p>
                        <p><strong>Analysis:</strong> {{ $poll->analysis }}</p>
                        <p><strong>Slug:</strong> {{ $poll->slug }}</p>
                        @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                        (auth()->check() && $poll->users()->exists()))
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
                </div>
            @endforeach
        </div>
        <!-- Add Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <x-nav-bar/>
@endsection

@section('scripts')
    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto', // Adjusts automatically based on width
            spaceBetween: 10, // Space between slides
            centeredSlides: true, // Centers the main card
            loop: true, // Infinite scroll
            grabCursor: true, // User can drag the slides
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3, // For desktops
                    spaceBetween: 20,
                },
                480: {
                    slidesPerView: 1.5, // Partial card visibility on smaller screens
                    spaceBetween: 15,
                },
            },
            on: {
                slideChangeTransitionStart: function () {
                    document.querySelectorAll('.swiper-slide').forEach(slide => {
                        slide.style.transform = 'scale(0.9)';
                        slide.style.opacity = '0.8';
                    });
                },
                slideChangeTransitionEnd: function () {
                    document.querySelector('.swiper-slide-active').style.transform = 'scale(1.1)';
                    document.querySelector('.swiper-slide-active').style.opacity = '1';
                }
            }
        });
    </script>


@endsection
