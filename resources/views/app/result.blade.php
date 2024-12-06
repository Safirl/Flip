@extends('base')


@section('title', 'Result')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection
@section('content')

    <form action="{{ session('previous_url') }}"
          method="get">
        <div class="back-bar">
            <x-button
                size="large"
                color="primary"
                kind="outlined"
                label=""
                iconEnd="fa-solid fa-arrow-left"
                classes="btn-back"
            />

            <div class="bulb @if($poll->is_intox) intox-bulb @else info-bulb @endif ">
                <i class="fa-solid fa-lightbulb"></i>
                <h1 style="">
                    @if($poll->is_intox)
                        INTOX
                    @else
                        INFO
                    @endif
                </h1>
            </div>
        </div>
    </form>


{{--    @if($poll->is_intox == 1)--}}
{{--        <style>--}}
{{--            .bulb {--}}
{{--                background: var(--app-secondary-500);--}}
{{--            }--}}
{{--        </style>--}}

{{--    @else--}}
{{--        <style>--}}
{{--            .bulb {--}}
{{--                background: var(--app-primary-700);:--}}
{{--            }--}}
{{--        </style>--}}
{{--    @endif--}}


    @if (session()->has('completed_polls') && in_array($poll->id, session('completed_polls')) ||
                             (auth()->check() && $poll->users()->exists()))
        <div class="contenaireGraph">
            <div class="cadreFigure">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
            <div class="textContenaire">
                @if( $poll->is_intox == 1 )
                    <div class="contenaireCountMistake">
                        <p><strong>{{$intoxCount}}</strong> personnes ont cru à une intox. </p>
                        <p>Sur {{$intoxCount + $infoCount}} votants</p>
                    </div>
                    <p class="pourcent" style="color: #2399F3">
                        {{($intoxCount / ($intoxCount + $infoCount))*100 }}%
                    </p>

                @else
                    <div class="contenaireCountMistake">
                        <p><strong>{{$infoCount}}</strong> personnes ont cru à une intox sur {{$intoxCount + $infoCount}} votants. </p>
                        <p></p>
                    </div>
                    <p class="pourcent" style="color: #6420DF">
                        {{ round(($infoCount / ($intoxCount + $infoCount)) * 100) }}%
                    </p>
                @endif
            </div>
            @endif

            <form action="{{ route('comments.show', ['poll' => $poll]) }}" method="get">
                @csrf
                <x-button
                    size="large"
                    color="primary"
                    kind="filled"
                    iconEnd="fa-solid fa-chevron-right"
                    label="Voir les commentaires">
                </x-button>
            </form>
        </div>
        <div>
            <i class="fa-solid fa-book-open"></i>
            <h3>Contexte</h3>
        </div>
        <p>{{ $poll->context }}</p>
        <div></div>
        <div>
            <i class="fa-solid fa-magnifying-glass"></i>
            <h3>Analyse</h3>
        </div>
        <p>{{ $poll->analysis }}</p>


        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="module" src="/src/main.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var intoxCount = {{ $intoxCount }};
                var infoCount = {{ $infoCount }};
                var totalVotes = intoxCount + infoCount;

                Highcharts.chart('container', {
                    chart: {
                        type: 'pie',
                        backgroundColor: 'transparent', // Supprime le fond blanc
                    },
                    title: {
                        text: null
                    },


                    plotOptions: {
                        pie: {
                            allowPointSelect: false,
                            cursor: 'pointer',
                            innerSize: '90%',
                            dataLabels: {
                                enabled: false
                            }

                        }
                    },

                    series: [{
                        name: 'Votes',
                        colorByPoint: false,
                        data: [{
                            name: 'Intox',
                            y: {{ $intoxCount }},
                            color: 'var(--app-primary-500)'
                        }, {
                            name: 'Info',
                            y: {{ $infoCount }},
                            color: 'var(--app-secondary-500)'
                        }]
                    }]
                });
            });
        </script>
        <x-nav-bar/>
        @endsection
