@php use Carbon\Carbon; @endphp
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
                            <div class="w-full">
                                @foreach($mainTasks as $groupName => $groupTasks)
                                    <div class="rounded-md shadow mb-4">
                                        @if($groupName != null)
                                            <div
                                                class="bg-gray-300 dark:bg-gray-900 text-center py-2 rounded-t-md text-gray-600 dark:text-white font-thin text-lg">
                                                {{ $groupName }}
                                            </div>
                                        @endif
                                        @foreach($groupTasks as $task)
                                            <a @class(['rounded-t' => $groupName == null,
                                            'cursor-not-allowed' => $task['details']->starts_at?->isFuture(),
                                            'cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-750' =>  !$task['details']->starts_at?->isFuture(),
                                            'flex bg-white dark:bg-gray-800 w-full py-4 px-4 last:rounded-b last:border-0 items-center gap-4 border-b border-gray-400 dark:border-gray-600'])
                                               href="{{ route('courses.tasks.show', [$task['details']->course->id, $task['details']->id]) }}">
                                                @if($task['details']->grade() == null)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6 dark:text-gray-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                @else
                                                    @if($task['details']->grade()->value == GradeEnum::Passed)
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5" stroke="currentColor"
                                                             class="w-6 h-6 text-lime-green-500 dark:text-lime-green-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M14.563 9.75a12.014 12.014 0 00-3.427 5.136L9 12.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor"
                                                             class="w-6 h-6 text-lime-green-500 dark:text-red-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    @endif
                                                @endif
                                                <span
                                                    class="w-3/6 text-sm text-gray-600 dark:text-white">{{ $task['details']->name }}</span>
                                                <div class="w-2/6 flex flex-col">
                                                    <span class="text-xs dark:text-gray-400">
                                                        @if(Carbon::now() > $task['details']->starts_at)
                                                            Opened
                                                        @else
                                                            Opens
                                                        @endif
                                                    </span>
                                                    <span
                                                        class="text-sm dark:text-gray-200">{{ $task['details']->starts_at?->diffForHumans() }}</span>
                                                </div>
                                                <div class="w-2/6 flex flex-col">
                                                    <span class="text-xs dark:text-gray-400">
                                                        @if(Carbon::now() > $task['details']->ends_at)
                                                            Closed
                                                        @else
                                                            Closes
                                                        @endif
                                                    </span>
                                                    <span
                                                        class="text-sm dark:text-gray-200">{{ $task['details']->ends_at?->diffForHumans() }}</span>
                                                </div>
                                                @can('viewInvisible', $course)
                                                    <div class="text-lime-green-700 task-visibility">
                                                        @if($task['details']->is_visible)
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 fill="currentColor" class="w-5 h-5">
                                                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                                                                <path fill-rule="evenodd"
                                                                      d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 fill="currentColor" class="w-5 h-5">
                                                                <path
                                                                    d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z"/>
                                                                <path
                                                                    d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z"/>
                                                                <path
                                                                    d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z"/>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                @endcan
                                            </a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <section class="w-1/3">
                            @foreach($course->tracks()->whereNull('parent_id')->get() as $track)
                                <a href="{{ route('courses.tracks.show', [$course->id, $track->id]) }}"
                                   class="bg-lime-green-400 shadow-lg text-white rounded-md px-4 py-2 flex mb-4">
                                    <svg class="text-white flex-shrink-0 h-20 w-20 fill-current -ml-4"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="m12 3.879-7.061 7.06 2.122 2.122L12 8.121l4.939 4.94 2.122-2.122z"></path>
                                        <path
                                            d="m4.939 17.939 2.122 2.122L12 15.121l4.939 4.94 2.122-2.122L12 10.879z"></path>
                                    </svg>
                                    <div class="flex flex-col flex-grow justify-between">
                                        <div class="flex flex-row my-1 justify-between w-full">
                                            <div class="flex flex-col">
                                                <h1 class="font-light text-xl">Track</h1>
                                                <h2 class="font-bold text-2xl -mt-2">{{ $track->name }}</h2>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span>{{ $track->immediateChildren->count() }} paths </span>
                                            </div>
                                        </div>
                                        <span class="text-gray-100 text-sm">{{ $track->description }}</span>
                                    </div>
                                </a>
                            @endforeach
                            <div class="flex flex-col">
                                @foreach($sidebarTasks as $assignment)
                                    @include('courses.partials.task', ['task' => $assignment])
                                @endforeach
                            </div>
                        </section>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
