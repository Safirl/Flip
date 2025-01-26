@props(['poll'])
@php
    $voted = $poll->userAnswer !== null;

    [$firstname, $lastname] = explode(' ', $poll->author);
@endphp

<article class="poll-card @if($poll->userAnswer !== null) {{ $poll->is_intox ? 'intox': 'info' }} @endif">
    <header>
        <h3>
            <span>{{ $firstname }}</span>
            <span>{{ $lastname }}</span>
        </h3>

        <div>
            <p>{{ $poll->source }}</p>
            <p>{{ $poll->date ? \Carbon\Carbon::parse($poll->date)->format('d.m.Y') : 'Date inconnue'}}</p>
        </div>
    </header>

    <section>
        <p>
            "{{ $poll->quote }}"
        </p>

        <a href="{{ route('app.result', ['poll' => $poll->slug]) }}">
            En savoir plus<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </a>
    </section>

    @if($voted)
        <section class="result">
            <div class="@if($poll->userAnswer===0) voted @endif @if($poll->is_intox) active @endif">
                <img src="{{ asset('images/sprites/thumb-black.png') }}" alt=""/>
                <img src="{{ asset('images/sprites/thumb-yellow.png') }}" alt=""/>

                <span>Intox</span>
            </div>

            <div class="@if($poll->userAnswer===1) voted @endif @if(!$poll->is_intox) active @endif">
                <img src="{{ asset('images/sprites/thumb-blue.png') }}" alt=""/>
                <img src="{{ asset('images/sprites/thumb-yellow.png') }}" alt=""/>
                <span>Info</span>
            </div>
        </section>
    @else
        <form action="{{ route('polls.answer', $poll) }}" method="POST">
            @csrf

            <input type="radio" id="intox-{{ $poll->id }}" name="answer" value="0">
            <label for="intox-{{ $poll->id }}">
                <x-poll.card-btn-bg/>
                <x-poll.card-btn-bg/>
                <img src="{{ asset('images/sprites/thumb-black.png') }}" alt=""/>
                <img src="{{ asset('images/sprites/thumb-yellow.png') }}" alt=""/>

                <span>Intox</span>
            </label>

            <input type="radio" id="info-{{ $poll->id }}" name="answer" value="1">
            <label for="info-{{ $poll->id }}">
                <x-poll.card-btn-bg/>
                <x-poll.card-btn-bg/>

                <img src="{{ asset('images/sprites/thumb-blue.png') }}" alt=""/>
                <img src="{{ asset('images/sprites/thumb-yellow.png') }}" alt=""/>
                <span>Info</span>
            </label>

            <button>
                <div>
                    <img src="{{ asset('images/icons/check.svg') }}" alt="Valider"/>
                </div>
            </button>
        </form>
    @endif

    <footer>
        @if ($voted)
            <p>Vous avez voté <span>{{ $poll->userAnswer ? 'info' : 'intox' }}</span></p>
        @endif
    </footer>

</article>
