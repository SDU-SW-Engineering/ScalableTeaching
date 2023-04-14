@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <div id="quantiles"></div>
        <div id="chart"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script>
        let comparisonTable = {!! json_encode($comparisonTable) !!};
        let quantiles = {!! $quantiles !!};
        let scores = {!!  $scores !!};
        let lastHoveredName = "";
        let xAxisLabels = undefined;
        var options = {
            series: scores,
            chart: {
                height: 600,
                type: 'heatmap',
                events: {
                    mouseMove: function (event, chartContext, config) {
                        //console.log(config); // dataPointIndex
                        //console.log(config.config.series[config.seriesIndex].data[config.dataPointIndex]);
                        //console.log(config);
                        if (config.config.series[config.seriesIndex] == null)
                            return;
                        if (xAxisLabels === undefined)
                            xAxisLabels = config.config.series[config.seriesIndex].data.map(x => x.x);
                        let data = config.config.series[config.seriesIndex].data[config.dataPointIndex];
                        let currentName = data.x;
                        if (currentName === lastHoveredName)
                            return;
                        lastHoveredName = currentName;

                        chartContext.clearAnnotations();
                        chartContext.addXaxisAnnotation({
                            x: comparisonTable[data.id].compared_with.name,
                            borderColor: '#880808',
                            label: {
                                style: {
                                    color: '#ff0000',
                                },
                                text: 'Most similar to'
                            }
                        })
                        for (let test of Object.values(comparisonTable).filter(x => x.compared_with.name === lastHoveredName)) {
                            chartContext.addXaxisAnnotation({
                                x: test.name,
                                borderColor: '#885f08',
                                label: {
                                    style: {
                                        color: '#ff9900',
                                    },
                                    text: 'Most similiar from'
                                }
                            })
                        }

                    },
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#008FFB"],
            title: {
                text: 'JPlag'
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var boxChart = new ApexCharts(document.querySelector("#chart"), {
            chart: {
                type: 'boxPlot',
                height: 500
            },
            title: {
                text: 'Quantiles',
                align: 'left'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '50%'
                },
                boxPlot: {
                    colors: {
                        upper: '#e9ecef',
                        lower: '#f8f9fa'
                    }
                }
            },
            stroke: {
                colors: ['#6c757d']
            },
            series: [
                {
                    data: quantiles
                }
            ]
        }).render();

    </script>
@endsection
