@extends('base')
@section('title', 'feed')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/polls.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endsection
@section('content')
    <h1 style="padding: 1.5rem 1.5rem 0;">Votes de la semaine</h1>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide">
                    <h4>{{ $poll->author }}</strong> :</h4>
                    <p class="author"><em>"{{ $poll->quote }}"</em></p>


<!-- TODO@HELOISE : add les routes des votes de la semaine, la stucture reste la même  -->


                    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                         (auth()->check() && $poll->users()->exists()))
                        <x-link
                            route="{{ route('app.result', ['poll' => $poll->slug]) }}"
                            label="Voir le contexte"
                            color="primary"
                            size="medium"
                            iconEnd="fa-solid fa-chevron-right"/>
                    @else

                        <form class="form" action="{{ route('app.result', ['poll' => $poll->slug]) }}" method="POST">
                            @csrf
                            <hr class="divider">
                            <div class="form-buttons">
                                <div class="buttons-item">
                                    <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                                    <label class="link labelIntox" for="intox-{{ $poll->id }}">
                                        <img  class="notfocus" src="{{ asset('images/crossViolet.svg') }}" alt="intox">
                                        <img  class="focus" src="{{ asset('images/cross.svg') }}" alt="intox">
                                        <p><em>Intox</em></p>
                                    </label>
                                </div>
                                <div class="buttons-item">
                                    <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                                    <label class="link labelInfo" for="info-{{ $poll->id }}">
                                        <img  class="focus" src="{{ asset('images/icon-circle-bulb.svg') }}" alt="info">
                                        <img  class="notfocus " src="{{ asset('images/icon-circle-bulb-bleu.svg') }}" alt="info">
                                        <p><em>Info</em></p>
                                    </label>
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
