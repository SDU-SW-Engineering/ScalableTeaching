@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full">
                @if($tasks->count() == 0 && $course->tracks->count() == 0)
                    <h1 class="dark:text-gray-400 w-full text-center mt-12 text-xl">No tasks available. Check back
                        later.</h1>
                @else
                    <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                        @foreach($course->tracks()->whereNull('parent_id')->get() as $track)
                            <div class="bg-lime-green-400 shadow-lg text-white rounded-md px-4 py-2 flex">
                                <svg class="text-white flex-shrink-0 h-20 w-20 fill-current -ml-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24" style="transform: ;msFilter:;">
                                    <path d="m12 3.879-7.061 7.06 2.122 2.122L12 8.121l4.939 4.94 2.122-2.122z"></path>
                                    <path
                                        d="m4.939 17.939 2.122 2.122L12 15.121l4.939 4.94 2.122-2.122L12 10.879z"></path>
                                </svg>
                                <div class="flex flex-col flex-grow justify-between">
                                    <div class="flex flex-row my-1 justify-between w-full">
                                        <div class="flex flex-col">
                                            <h1 class="font-light text-2xl">Track</h1>
                                            <h2 class="font-bold text-4xl -mt-2">{{ $track->name }}</h2>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span>{{ $track->immediateChildren->count() }} paths </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-gray-100 text-sm">{{ $track->description }}</span>
                                        <div class="my-3">
                                            <a href="{{ route('courses.tracks.show', [$course->id, $track->id]) }}"
                                               class="bg-lime-green-700 transition-colors hover:bg-lime-green-800 py-2 px-3 rounded-md text-lg">Open</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
