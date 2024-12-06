@extends('base')

@section('title', 'Votes du jour')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/polls.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endsection

@section('content')
    <h1 style="padding: 1.5rem 1.5rem 0;">@if($isFeed) Votes de la semaine @else Votes du jour @endif </h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide">

                    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                        (auth()->check() && $poll->users()->exists()))


                        <div class="contenaireInformationVote">
                            <div class="bulb @if($poll->is_intox) intox-bulb @else info-bulb @endif ">
                                <i class="fa-solid fa-lightbulb"></i>
                                <h1>
                                    @if($poll->is_intox)
                                        INTOX
                                    @else
                                        INFO
                                    @endif
                                </h1>
                            </div>
                        </div>




                        @if ($poll->id == old('poll_id'))
                            @dump($answer)

                        @endif
                        @if ($answer !== null)
                            <p>Votre réponse : {{ $answer ? 'Info' : 'Intox' }}</p>
                        @endif
                    @endif
                    <h4>{{ $poll->author }}</strong> :</h4>
                    <p class="author"><em>"{{ $poll->quote }}"</em></p>

                        @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                       (auth()->check() && $poll->users()->exists()))

                        @else
                        <x-link
                            route="{{ route('app.result', ['poll' => $poll->slug]) }}"
                            label="Voir le contexte"
                            color="primary"
                            size="medium"
                            iconEnd="fa-solid fa-chevron-right"/>


                        <hr class="divider">
                        @endif
                        @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                      (auth()->check() && $poll->users()->exists()))
                            @dump("sondage here")
                            <p> {{ $poll->intoxCount }} </p>
                            <p>Info : {{ $poll->infoCount }}</p>
                        @else
{{--                           --}}
{{--                            action="{{ route('app.polls', ['poll' => $poll->slug]) }}"--}}
                            <form class="form" action="{{ route('polls') }}" method="POST">
                                @csrf
                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">

                                <div class="form-buttons">
                                    <div class="buttons-item">
                                        <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                                        <label class="link labelIntox" for="intox-{{ $poll->id }}">
                                            <img class="notfocus" src="{{ asset('images/crossViolet.svg') }}" alt="intox">
                                            <img class="focus" src="{{ asset('images/cross.svg') }}" alt="intox">
                                            <p><em>Intox</em></p>
                                        </label>
                                    </div>
                                    <div class="buttons-item">
                                        <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                                        <label class="link labelInfo" for="info-{{ $poll->id }}">
                                            <img class="focus" src="{{ asset('images/icon-circle-bulb.svg') }}" alt="info">
                                            <img class="notfocus" src="{{ asset('images/icon-circle-bulb-bleu.svg') }}" alt="info">
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
