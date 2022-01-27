@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full">
                @if($tasks->count() == 0)
                    <h1 class="dark:text-gray-400 w-full text-center mt-12 text-xl">No tasks available. Check back later.</h1>
                @else
                    <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                        @foreach($inProgress as $task)
                            @include('courses.partials.course', ['task' => $task])
                        @endforeach
                    </div>
                    @if($upcoming->count() > 0)
                        <div class="mb-4">
                            <h2 class="text-xl mb-1 dark:text-gray-200">Upcoming</h2>
                            <hr class="w-full h-0.5 bg-gray-300 dark:bg-gray-500 rounded">
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 gap-4">
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
                        <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 gap-4">
                            @foreach($past as $task)
                                @include('courses.partials.course', ['task' => $task])
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
