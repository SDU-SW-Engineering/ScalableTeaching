@php use App\Models\Project; @endphp
@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <div class="flex justify-between items-center">
            <h1 class="mb-4 flex items-center">
                <a class="text-lime-green-500"
                   href="{{ route('courses.tasks.admin.plagiarismDetection.dashboard', [$course, $task]) }}">Overview</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                <span class="font-bold mr-2">{{ $project->owner_names }}</span>
                vs {{ Project::find($overlap->perspective($project->id)['to'])->owner_names }}</h1>
            <div class="flex gap-4 items-center">
                <a class="bg-lime-green-500 h-10 flex items-center px-2 text-white rounded-md hover:bg-lime-green-400 text-sm"
                   target="_blank"
                   href="{{ route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $project->id , 'with' => [$overlap->perspective($project->id)['to']]]) }}">Open
                    Comparison View</a>
                @if($isSuspicious)
                    <a href="{{ route('courses.tasks.admin.plagiarismDetection.removeSuspicions', [$course, $task, $project->id , 'to' => $overlap->perspective($project->id)['to']]) }}"
                       class="p-2 h-10 rounded-md bg-red-600 text-white hover:bg-red-700 ">
                        <svg
                            v-if="!isSuspicious"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"
                            />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('courses.tasks.admin.plagiarismDetection.addSuspicions', [$course, $task, $project->id , 'to' => $overlap->perspective($project->id)['to']]) }}"
                       class="p-2 h-10 rounded-md hover:bg-red-600 hover:text-white">
                        <svg
                            v-if="!isSuspicious"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"
                            />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
        <div id="quartiles"></div>
        <div>
            <h2>Other comparisons</h2>
            <div>
                @foreach($other as $entry)
                    <div class="flex items-center justify-center text-sm hover:bg-gray-200 py-1">
                        <div class="w-4/6"><a
                                href="{{ route('courses.tasks.admin.plagiarismDetection.details', [$course, $task, $project->id, $entry->perspective($project->id)['to']]) }}">{{ Project::find($entry->perspective($project->id)['to'])->owner_names }}</a>
                        </div>
                        <div class="w-2/6 items-center flex">
                            <div class="relative w-1/2">
                                <div class="h-5 bg-gray-400 text-sm rounded-lg text-center absolute w-full"
                                     style="margin-top:-10px"></div>
                                <div class="h-5 {{ match(true){
    $entry->overlap > 0.8 => 'bg-red-900',
    $entry->overlap > 0.5 => 'bg-yellow-700',
    default => 'bg-lime-green-900'
} }} text-sm rounded-lg text-white text-center absolute"
                                     style="width:{{$entry->overlap*100}}%;margin-top:-10px">{{ round($entry->overlap*100,1) }}
                                    %
                                </div>
                            </div>

                            <div>
                                <a class="underline text-lime-green-500 ml-2"
                                   href="{{ route('courses.tasks.admin.plagiarismDetection.details', [$course, $task, $project->id, $entry->perspective($project->id)['to']]) }}">Details</a>
                                - <a class="underline text-lime-green-500" target="_blank"
                                     href="{{ route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $project->id , 'with' => [$entry->perspective($project->id)['to']]]) }}">Show
                                    Comparison</a>
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
        let quartiles = {!! $quartiles !!};

        let userPlots = {!! $userPlots !!};
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
            colors: [
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
