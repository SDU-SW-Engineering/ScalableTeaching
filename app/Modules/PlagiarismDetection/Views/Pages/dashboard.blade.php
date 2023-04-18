@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <div id="quantiles"></div>
        <div id="chart"></div>
        <div class="flex flex-col mt-4">
            <h1 class="text-xl font-medium mb-4">Comparisons</h1>
            <div class="flex flex-col gap-1">
                <div class="flex">
                    <div class="w-2/4">Name</div>
                    <div class="w-1/4">Compared with</div>
                    <div class="w-1/4">Overlap</div>
                </div>
                @foreach($similarities->sortByDesc(fn($similarity) => $similarity->getOverlap()) as $projectId => $entry)
                    <div class="flex text-sm hover:bg-gray-200 py-1">
                        <div class="w-2/4"><a
                                href="{{ route('courses.tasks.admin.plagiarismDetection.details', [$course, $task, $projectId]) }}">{{ $entry->project()->owner_names }}</a>
                        </div>
                        <div class="w-1/4">{{ $entry->comparedWith()->owner_names }}</div>
                        <div class="w-1/4 items-center flex relative">
                            <div class="h-5 bg-gray-400 text-sm rounded-lg text-center absolute w-full"></div>
                            <div class="h-5 {{ match(true){
    $entry->getOverlap() > 0.8 => 'bg-red-900',
    $entry->getOverlap() > 0.5 => 'bg-yellow-900',
    default => 'bg-lime-green-900'
} }} text-sm rounded-lg text-white text-center absolute"
                                 style="width:{{$entry->getOverlap()*100}}%">{{ round($entry->getOverlap()*100,1) }}%
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script>
        let similarities = {!! json_encode($similarities) !!};
        let quantiles = {!! $quartiles !!};
        let scores = {!!  $scores !!};
        let lastHoveredId = "";
        let xAxisLabels = undefined;
        let nameMap = {!! $nameMap->toJson() !!};
        const options = {
            series: scores,
            chart: {
                height: 600,
                type: 'heatmap',
                events: {
                    mouseMove: function (event, chartContext, config) {
                        if (config.config.series[config.seriesIndex] == null)
                            return;
                        if (xAxisLabels === undefined)
                            xAxisLabels = config.config.series[config.seriesIndex].data.map(x => x.x);
                        let data = config.config.series[config.seriesIndex].data[config.dataPointIndex];
                        let currentId = data.id;
                        if (currentId === lastHoveredId)
                            return;
                        lastHoveredId = currentId;
                        chartContext.clearAnnotations();
                        let currentSimilarity = similarities[currentId];
                        chartContext.addXaxisAnnotation({
                            x: `${currentSimilarity.compared_with}`,
                            borderColor: '#880808',
                            label: {
                                style: {
                                    color: '#ff0000',
                                },
                                text: 'Most similar to'
                            }
                        })
                        for (let similarFrom of Object.values(similarities).filter(x => currentId === x.compared_with)) {
                            if (similarFrom.id === currentSimilarity.compared_with)
                                continue;
                            chartContext.addXaxisAnnotation({
                                x: `${similarFrom.id}`,
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
            xaxis: {
                labels: {
                    formatter: function (projectId) {
                        return nameMap[projectId];
                    }
                }
            },
            colors: ["#008FFB"],
            title: {
                text: 'JPlag'
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var boxChart = new ApexCharts(document.querySelector("#quantiles"), {
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
