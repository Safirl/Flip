@extends('base')

@section('title', 'Votes du jour')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/polls.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endsection

@section('content')
    <h1 style="padding: 1.5rem 1.5rem 0;">Votes du jour</h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide">
                    <h4>{{ $poll->author }}</strong> :</h4>
                    <p class="author"><em>"{{ $poll->quote }}"</em></p>
                    {{-- <p><strong>Context:</strong> {{ $poll->context }}</p> --}}
                    {{--<p><strong>Analysis:</strong> {{ $poll->analysis }}</p>--}}

                    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                         (auth()->check() && $poll->users()->exists()))
                        <a href="{{ route('app.result', ['poll' => $poll->slug]) }}">Lire la suite</a>
                    @else
                        <form class="form" action="{{ route('app.result', ['poll' => $poll->slug]) }}" method="POST">
                            @csrf
                            <div class="form-buttons">
                                <div class="buttons-item">
                                    <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                                    <label for="intox-{{ $poll->id }}">Intox</label>
                                </div>
                                <div class="buttons-item">
                                    <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                                    <label for="info-{{ $poll->id }}">Info</label>
                                </div>
                            </div>
                            <x-button id="submit-button"
                                      type="submit"
                                      size="large"
                                      color="primary"
                                      label="Valider"
                                      iconStart="fa-solid fa-check"
                                      class="hidden"
                            />
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
