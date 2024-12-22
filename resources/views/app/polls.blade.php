@extends('base')

@section('title', 'Votes du jour')
@vite(['resources/css/polls.css'])
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>--}}

@section('content')
    <h1 style="padding: 1.5rem 1.5rem 0;">@if($isFeed) Votes de la semaine @else Votes du jour @endif </h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide">

                    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                        (auth()->check() && $poll->users()->exists()))

                        <div class="contenaireinfoResultAndVote @if($poll->is_intox) intox-contenaire @else info-contenaire @endif">
                            <div class="bulb @if($poll->is_intox) intox-bulb @else info-bulb @endif ">
                                <h1 style="">
                                    @if($poll->is_intox)

                                        <img class="" src="{{asset('../images/cross.svg')}}" alt="intox">
                                        INTOX
                                    @else
                                        <img class="logo" src="{{asset('../images/icon-circle-bulb.svg')}}" alt="info">
                                        INFO
                                    @endif
                                </h1>
                            </div>




                        @if ($poll->id == old('poll_id'))


                        @endif
                        @if ($answer !== null)
                            <div class="reponse">
                                <h4><strong>Vous avez voté </strong></h4>
                                <p  class="{{ $answer ? 'bg-blue' : 'bg-purple' }}"> <em>
                                        {{ $answer ? 'INFO' : 'INTOX' }}
                                    </em></p>
                            </div>
                        @endif
                        </div>
                    @endif
                    <div class="CardContent">
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

                            <div class="textContenaire">
                                @if( $poll->is_intox == 1 )
                                    <div class="contenaireCountMistake">
                                        <p><strong>{{ $poll->intoxCount}}</strong> personnes ont cru à une intox. </p>
                                        <p>Sur {{ $poll->intoxCount + $poll->infoCount}} votants</p>
                                    </div>
                                    <p class="pourcent" style="color: #6420DF">
                                        {{( $poll->intoxCount / ( $poll->intoxCount + $poll->infoCount))*100 }}%
                                    </p>

                                @else
                                    <div class="contenaireCountMistake">
                                        <p><strong>{{$poll->infoCount}}</strong> personnes ont cru à une intox sur {{ $poll->intoxCount + $poll->infoCount}} votants. </p>
                                        <p>Sur {{ $poll->intoxCount + $poll->infoCount}} votants</p>
                                    </div>
                                    <p class="pourcent" style="color: #2399F3">
                                        {{ round(($poll->infoCount / ( $poll->intoxCount + $poll->infoCount)) * 100) }}%
                                    </p>
                                @endif
                            </div>
                            <x-link
                                route="{{ route('app.result', ['poll' => $poll->slug]) }}"
                                label='Voir pourquoi'
                                color="primary"
                                size="medium"
                                iconEnd="fa-solid fa-chevron-right"/>
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
                </div>
            @endforeach
        </div>
    </div>





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
