@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 mb-4">
            <ul class="flex flex-wrap -mb-px">
                <!--<li class="mr-2">
                    <button id="normal-tab" onclick="activateTab('normal')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Normal Distribution
                    </button>
                </li>-->
                <li class="mr-2">
                    <button id="graph-tab" onclick="activateTab('graph')"
                            class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                            aria-current="page">Graph
                    </button>
                </li>
                <li class="mr-2">
                    <button id="quantiles-tab" onclick="activateTab('quantiles')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        Quantiles
                    </button>
                </li>
                <li class="mr-2">
                    <button id="heatmap-tab" onclick="activateTab('heatmap')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                        HeatMap
                    </button>
                </li>
            </ul>
        </div>
        <div id="normal" style="display:none"></div>
        <div id="graph" style="display:none">
            <div id="cy"></div>
        </div>
        <div id="quantiles"></div>
        <div id="heatmap"></div>
        <div class="flex flex-col mt-4">
            <h1 class="text-xl font-medium mb-4">Comparisons</h1>
            <div class="flex flex-col gap-1">
                <div class="flex">
                    <div class="w-2/6">Name</div>
                    <div class="w-2/6">Top Overlap</div>
                    <div class="w-2/6">Overlap</div>
                </div>
                @foreach($similarities->sortByDesc(fn($similarity) => $similarity->getOverlap()) as $entry)
                    <div class="flex items-center justify-center text-sm hover:bg-gray-200 py-1">
                        <div class="w-2/6"><a
                                href="{{ route('courses.tasks.admin.plagiarismDetection.details', [$course, $task, $entry->getProjectId()]) }}">{{ $entry->project()->owner_names }}</a>
                        </div>
                        <div class="w-2/6">{{ $entry->comparedWith()->owner_names }}</div>
                        <div class="w-2/6 items-center flex">
                            <div class="relative w-1/2">
                                <div class="h-5 bg-gray-400 text-sm rounded-lg text-center absolute w-full" style="margin-top:-10px"></div>
                                <div class="h-5 {{ match(true){
    $entry->getOverlap() > 0.8 => 'bg-red-900',
    $entry->getOverlap() > 0.5 => 'bg-yellow-700',
    default => 'bg-lime-green-900'
} }} text-sm rounded-lg text-white text-center absolute"
                                   style="width:{{$entry->getOverlap()*100}}%;margin-top:-10px">{{ round($entry->getOverlap()*100,1) }}
                                    %
                                </div>
                            </div>

                            <div>
                                <a class="underline text-lime-green-500 ml-2" href="{{ route('courses.tasks.admin.plagiarismDetection.details', [$course, $task, $entry->getProjectId()]) }}">Details</a>
                                - <a class="underline text-lime-green-500" target="_blank" href="{{ route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $entry->getProjectId() , 'with' => [$entry->comparedWith()->id]]) }}">Show Comparison</a>
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
    <script src="{{ asset('js/cytoscape.min.js') }}"></script>
    <script>
        let tabs = [ {
            name: "Graph",
            active: true,
            id: "graph"
        }, {
            name: "Quantiles",
            active: false,
            id: "quantiles"
        }, {
            name: "Heatmap",
            active: false,
            id: "heatmap"
        }];
        let renderTabs = function () {
            for (tab of tabs) {
                if (tab.active) {
                    document.getElementById(`${tab.id}-tab`).classList.remove(...document.getElementById(`${tab.id}-tab`).classList);
                    document.getElementById(`${tab.id}-tab`).classList.add("inline-block", "p-4", "text-blue-600", "border-b-2", "border-blue-600", "rounded-t-lg", "active", "dark:text-blue-500", "dark:border-blue-500")
                    document.getElementById(tab.id).style.display = 'block';
                } else {
                    document.getElementById(`${tab.id}-tab`).classList.remove(...document.getElementById(`${tab.id}-tab`).classList)
                    document.getElementById(`${tab.id}-tab`).classList.add("inline-block", "p-4", "border-b-2", "border-transparent", "rounded-t-lg", "hover:text-gray-600", "hover:border-gray-300", "dark:hover:text-gray-300");
                    document.getElementById(tab.id).style.display = 'none';
                }
            }
        }
        let activateTab = function (tabId) {
            tabs.forEach(tab => {
                tab.active = tab.id === tabId
            })
            renderTabs();
        }
        renderTabs();
        let similarities = {!! json_encode($similarities) !!};
        let normalDist = {!! $normal !!};
        let quantiles = {!! $quartiles !!};
        let scores = {!!  json_encode($scores, JSON_PRETTY_PRINT) !!};
        let lastHoveredId = "";
        let xAxisLabels = undefined;
        let nameMap = {!! $nameMap->toJson() !!};

        var cy = cytoscape({
            container: document.getElementById('cy'), // container to render in
            elements: {!! json_encode($network) !!},
            layout: {
                name: "cose",
                nodeDimensionsIncludeLabels: true
            },
            style: [ // the stylesheet for the graph
                {
                    selector: 'node',
                    style: {
                        'background-color': '#666',
                        'label': 'data(name)'
                    }
                },

                {
                    selector: 'edge',
                    style: {
                        'width': 3,
                        'line-color': '#ccc',
                        'target-arrow-color': '#ccc',
                        'target-arrow-shape': 'triangle',
                        'curve-style': 'bezier',
                        'label': 'data(overlap)'
                    }
                }
            ],
        });

        cy.bind('tapstart', 'edge', function(event) {
            var connected = event.target.connectedNodes();
            console.log(connected[0].data(), connected[1].data());
            window.open( `${window.location.pathname}/compare/${connected[0].data().id}?with[]=${connected[1].data().id}`, '_blank').focus();
        });

        const options = {
            series: scores,
            chart: {
                height: 800,
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
                        // return projectId;
                        return `${nameMap[projectId]}`;
                    }
                }
            },
            colors: ["#008FFB"],
            title: {
                text: 'HeatMap'
            },
        };

        var chart = new ApexCharts(document.querySelector("#heatmap"), options);
        chart.render();

        var chart = new ApexCharts(document.querySelector("#normal"), {
            chart: {
                type: 'line'
            },
            xaxis: {
                min: 1,
                max: 100
            },
            series: [
                {
                    name: "Normal",
                    data: normalDist
                }
            ],
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return `${parseFloat(val*100).toFixed(2)}%`;
                    }
                }
            },
        }).render()

        var boxChart = new ApexCharts(document.querySelector("#quantiles"), {
            chart: {
                type: 'boxPlot',
                height: 500
            },
            title: {
                text: 'Quantiles',
                align: 'left'
            },
            xaxis: {
                max: 100
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

@section('styles')
    <style>
        #cy {
            width: 100%;
            height: 500px;
            display: block;
        }
    </style>
@endsection
