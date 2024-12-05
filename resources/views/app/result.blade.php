@extends('base')


@section('title', 'Result')

@section('content')

    <div class="contenaireInformationVote">
        @if($answer == 1)
             <img src="{{ asset('images/icon-circle-bulb.svg') }}" alt="Info">
        @endif
            @if( $answer == false))
            <img src="{{ asset('images/cross.svg') }}"  alt="Intox">
        @endif
    <h1>{{ $answer == 1 ? 'INFO' : 'INTOX' }}</h1>
    </div>

    @if($answer ==1)
        <style>
            .contenaireInformationVote{
                background:  #2399F3;
            }
        </style>

    @else
        <style>
            .contenaireInformationVote{
                background: #6420DF;
            }
        </style>
    @endif





    <div class="contenaireGraph">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
        <div class="textContenaire">
            <p><strong>{{$intoxCount}}</strong> personnes pensenet que c'est une intox</p>
            <p>Sur {{$intoxCount + $infoCount}} votants</p>
        </div>
         <a href="#" class="link"> voir les commentaires</a>
    </div>
 <!--   <h2>{{ $poll->title }}</h2>
    <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
    <p><strong>Author:</strong> {{ $poll->author }}</p>
    <p><strong>Context:</strong> {{ $poll->context }}</p>
    <p><strong>Slug:</strong> {{ $poll->slug }}</p>-->
    {{--<p><strong>Analysis:</strong> {{ $poll->analysis }}</p>--}}
    <img src="{{ asset('images/context.svg') }}"  alt="context">
    <h3>Contexte</h3>
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
                        innerSize: '90%', //
                        dataLabels: {
                            enabled: false // Désactive les labels
                        }

                    }
                },



                series: [{
                    name: 'Votes',
                    colorByPoint: false,
                    data: [{
                        name: 'Intox',
                        y: {{ $intoxCount }},
                        color: '#6420DF' // Couleur personnalisée
                    }, {
                        name: 'Info',
                        y: {{ $infoCount }},
                        color: '#2399F3' // // Couleur personnalisée
                    }]
                }]
            });
        });
    </script>


    <x-nav-bar/>



    <style>
        .contenaireInformationVote{
            display: flex;
            justify-content: center;
            align-content: center;
            gap:  0.25rem;
            padding-bottom:  0.25rem;
            padding-top:  0.25rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;

            border-radius: 50px;
        }

        .contenaireInformationVote h1{
            margin: 0;
            color: white;
        }

        figure{
            width: 100%;
            max-width: 15rem;
            transform: translateY(-5rem);
        }


        .contenaireGraph{
            border-radius:  0.75rem;
            border: 1px solid  #D9D9D9;
            background: rgba(252, 252, 252, 0.50);
            width: 100%;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-content: center;
            flex-wrap: wrap;
            flex-direction: column;
            align-items: center;



        }
        .contenaireGraph p {
            margin: 0;
            font-size: 12px;
        }

        .textContenaire{
            transform: translateY(-4rem);
            width: 100%;
        }
    </style>

@endsection
