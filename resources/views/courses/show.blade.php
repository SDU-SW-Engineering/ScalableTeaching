@extends('master')

@section('content')
    @include('partials.subnavbar')
    <div class="px-6 pt-4 container">
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full lg:w-2/3 xl:w-3/4">
                <div class="mb-4">
                    <h2 class="text-xl mb-1 dark:text-gray-200">In progress</h2>
                    <hr class="w-full h-0.5 bg-gray-300 dark:bg-gray-500 rounded">
                </div>
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    @foreach($course->tasks as $task)
                        @include('courses.partials.course', ['task' => $task])
                    @endforeach
                </div>
            </div>
            <div class="w-full lg:w-1/3 xl:w-1/4">
                <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 flex p-4">
                    <div class="w-16 h-16">
                        <simple-doughnut-chart :data="[2,2, 1]"></simple-doughnut-chart>
                    </div>
                    <div class="ml-4">
                        <h1 class="font-bold text-lg dark:text-white">Completed Tasks</h1>
                        <p class="text-gray-500 dark:text-gray-400">You have completed <b class="text-lime-green-500">2/5</b>
                            tasks and failed <b class="text-red-400">2/5</b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
