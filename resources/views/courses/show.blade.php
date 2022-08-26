@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full">
                @if($course->tasks()->count() == 0 && $course->tracks->count() == 0)
                    <h1 class="dark:text-gray-400 w-full text-center mt-12 text-xl">No tasks available. Check back
                        later.</h1>
                @else
                    <div class="flex w-full mb-40 gap-16">
                        <section class="w-2/3 ">
                            <h2 class="text-black dark:text-white font-semibold text-lg mb-2">Exercises</h2>
                            <div class="w-full">
                                @foreach($exerciseGroups as $groupName => $group)
                                    <div class="rounded-md shadow mb-4">
                                        @if($groupName != null)
                                            <div
                                                class="bg-gray-300 dark:bg-gray-900 text-center py-2 rounded-t-md text-gray-600 dark:text-white font-thin text-lg">
                                                {{ $groupName }}
                                            </div>
                                        @endif
                                        @foreach($group as $exercise)
                                            <a @class(['rounded-t' => $groupName == null, 'flex bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-750 w-full py-4 px-4 last:rounded-b last:border-0 items-center gap-4 border-b border-gray-400 dark:border-gray-600'])
                                               href="{{ route('courses.tasks.show', [$exercise['details']->course, $exercise['details']->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="w-5 h-5 text-lime-green-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.563 9.75a12.014 12.014 0 00-3.427 5.136L9 12.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="w-1/2 text-sm text-gray-600 dark:text-white">Exercise
                                                    1</span>
                                                <span></span>
                                            </a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <section class="w-1/3">
                            <h2 class="text-black dark:text-white font-semibold text-lg mb-2">Assignments</h2>
                            <div class="flex flex-col">
                                @foreach($assignments as $assignment)
                                    @include('courses.partials.course', ['task' => $assignment])
                                @endforeach
                            </div>
                        </section>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
