@vite(['resources/css/polls.scss'])
@vite(['resources/js/polls.js'])

<x-layouts.base-with-nav title="Votes du jour">
    <header>
        <h1>
            @if($isFeed)
                Quotes de la semaine
            @else
                Quotes du jour
            @endif
        </h1>

    </header>

    <div class="swiper pollsSwiper">
        <div class="swiper-wrapper">
            @foreach ($polls as $poll)
                <div class="swiper-slide" data-poll-id="{{ $poll->id }}">
                    <x-poll.card :poll="$poll"/>
                </div>
            @endforeach
        </div>

        <nav>
            <button class="polls-previous">
                <img src="{{ asset('images/icons/chevron-right.svg') }}" alt="Précédent"/>
            </button>

            <button class="polls-next">
                <img src="{{ asset('images/icons/chevron-right.svg') }}" alt="Suivant"/>
            </button>
        </nav>
    </div>
</x-layouts.base-with-nav>
