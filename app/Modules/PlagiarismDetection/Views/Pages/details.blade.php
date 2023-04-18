@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <h1 class="mb-4 flex items-center">
            <a class="text-lime-green-500" href="{{ route('courses.tasks.admin.plagiarismDetection.dashboard', [$course, $task]) }}">JPlag Results</a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

            {{ $project->owner_names }}</h1>
        <div id="quartiles"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script>
        let quartiles = {!! $quartiles !!};

        let userPlots = {!! $userPlots !!};
        console.log(userPlots, quartiles);
        var boxChart = new ApexCharts(document.querySelector("#quartiles"), {
            chart: {
                type: 'boxPlot',
                height: 500
            },
            title: {
                text: 'Quartiles',
                align: 'left'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '50%',
                },
                boxPlot: {
                    colors: {
                        upper: '#e9ecef',
                        lower: '#f8f9fa',
                    }
                },
            },
            fill: {
                opacity: 0.3,
            },
            stroke: {
                colors: ['#6c757d']
            },
            colors:  [
                '#6c757d', '#ff337a'
            ],
            series: [
                {
                    type: 'boxPlot',
                    data: quartiles,
                    name: 'File Overlap Quartiles'
                },
                {
                    type: 'bar',
                    data: userPlots,
                    name: "{{ $project->owner_names }}"
                }
            ]
        }).render();
    </script>
@endsection
