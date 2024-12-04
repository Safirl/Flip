@extends('base')


@section('title', 'Result')

@section('content')

    <h2>{{ $poll->title }}</h2>
    <p><strong>Quote:</strong> "{{ $poll->quote }}"</p>
    <p><strong>Author:</strong> {{ $poll->author }}</p>
    <p><strong>Context:</strong> {{ $poll->context }}</p>
    <p><strong>Analysis:</strong> {{ $poll->analysis }}</p>
    <p><strong>Slug:</strong> {{ $poll->slug }}</p>

    <p><strong>Your answer:</strong> {{ $answer == 1 ? 'Info' : 'Intox' }}</p>








        <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>

    <script type="module" src="/src/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('container', {
                chart: {
                    type: 'pie',
                    backgroundColor: 'transparent', // Supprime le fond blanc
                },
                title: {
                    text: null
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        innerSize: '90%', // Définit le diamètre du trou (70% du total)
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Votes',
                    colorByPoint: true,
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




@endsection
