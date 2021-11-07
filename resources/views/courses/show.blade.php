@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full lg:w-2/3 xl:w-3/4">
                @if($tasks->count() == 0)
                    <h1 class="dark:text-gray-400 w-full text-center mt-12 text-xl">No tasks available. Check back later.</h1>
                @else
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                        @foreach($inProgress as $task)
                            @include('courses.partials.course', ['task' => $task])
                        @endforeach
                    </div>
                    @if($upcoming->count() > 0)
                        <div class="mb-4">
                            <h2 class="text-xl mb-1 dark:text-gray-200">Upcoming</h2>
                            <hr class="w-full h-0.5 bg-gray-300 dark:bg-gray-500 rounded">
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                            @foreach($upcoming as $task)
                                @include('courses.partials.course', ['task' => $task, 'cantOpen' => true])
                            @endforeach
                        </div>
                    @endif
                    @if($past->count() > 0)
                        <div class="mb-4">
                            <h2 class="text-xl mb-1 dark:text-gray-200">Past</h2>
                            <hr class="w-full h-0.5 bg-gray-300 dark:bg-gray-500 rounded">
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                            @foreach($past as $task)
                                @include('courses.partials.course', ['task' => $task])
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
            <div class="w-full lg:w-1/3 xl:w-1/4">
                <div class="bg-white rounded-lg shadow-md dark:bg-gray-600 flex p-4 items-center">
                    <div class="w-16 h-16">
                        <simple-doughnut-chart
                            :data="[{{ $approvedCount }},{{$failedCount}}, {{ $remainingTaskCount }}]"></simple-doughnut-chart>
                    </div>
                    <div class="ml-4">
                        <h1 class="font-bold text-lg dark:text-white">Completed Tasks</h1>
                        <p class="text-gray-500 dark:text-gray-400">You have completed <b
                                class="text-lime-green-500">{{ $approvedCount }}/{{ $taskCount }}</b>
                            tasks and failed <b class="text-red-400">{{ $failedCount }}/{{ $taskCount }}</b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
