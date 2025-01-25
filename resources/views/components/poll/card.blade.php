<div class="swiper-slide">
    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
        (auth()->check() && $poll->users()->exists()))
        <div
            class="contenaireinfoResultAndVote @if($poll->is_intox) intox-contenaire @else info-contenaire @endif">
            <div class="bulb @if($poll->is_intox) intox-bulb @else info-bulb @endif ">
                <h1>
                    @if($poll->is_intox)
                        <img class="" src="{{asset('../images/cross.svg')}}" alt="intox">
                        INTOX
                    @else
                        <img class="logo" src="{{asset('../images/icon-circle-bulb.svg')}}" alt="info">
                        INFO
                    @endif
                </h1>
            </div>
            @if ($poll->userAnswer !== null)
                <div class="reponse">
                    <h4><strong>Vous avez voté </strong></h4>
                    <p class="{{ $poll->userAnswer ? 'bg-blue' : 'bg-purple' }}"><em>
                            {{ $poll->userAnswer ? 'INFO' : 'INTOX' }}
                        </em></p>
                </div>
            @endif
        </div>
    @endif
    <div class="CardContent">
        <div class="card-header">
            <h4>{{ $poll->author }} :</h4>
            <p class="author"><em>"{{ $poll->quote }}"</em></p>
        </div>
        @if($poll->image)
            <img style="width: 100%; height: 300px; object-fit: cover" src="{{$poll->imageUrl()}}"
                 alt="image du contexte">
        @endif
        @if ((auth()->check() && $poll->users()->exists()) || (session()->has('completed_polls') && in_array($poll->id, session('completed_polls'))))
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
                        <p><strong>{{$poll->infoCount}}</strong> personnes ont cru à une intox
                            sur {{ $poll->intoxCount + $poll->infoCount}} votants. </p>
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
            <form class="form" action="{{ route('polls') }}" method="POST">
                @csrf
                <input type="hidden" name="poll_id" value="{{ $poll->id }}">

                <div class="form-buttons">
                    <div class="buttons-item">
                        <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="false">
                        <label class="link labelIntox" for="intox-{{ $poll->id }}">
                            <img class="notfocus" src="{{ asset('images/crossViolet.svg') }}"
                                 alt="intox">
                            <img class="focus" src="{{ asset('images/cross.svg') }}" alt="intox">
                            <p><em>Intox</em></p>
                        </label>
                    </div>
                    <div class="buttons-item">
                        <input type="radio" id="info-{{ $poll->id }}" name="answer" value="true">
                        <label class="link labelInfo" for="info-{{ $poll->id }}">
                            <img class="focus" src="{{ asset('images/icon-circle-bulb.svg') }}"
                                 alt="info">
                            <img class="notfocus" src="{{ asset('images/icon-circle-bulb-bleu.svg') }}"
                                 alt="info">
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
