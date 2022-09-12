@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        <div class="flex gap-6 flex-wrap-reverse">
            <div class="flex-1 w-full">
                <div class="flex w-full">
                    <section class="w-1/4 py-5">
                        <aside class="w-64 dark:bg-gray-800 rounded shadow" aria-label="Sidebar">
                            <a href="http://localhost:8080/courses" class="flex items-center pl-2.5 mb-2">
                        <span
                            class="self-center text-xl font-semibold whitespace-nowrap text-lime-green-500">Courses</span>
                            </a>
                            @foreach($courses as $course)
                                <ul class="space-y-1">
                                    <li>
                                        <a href="{{ route('courses.show', $course) }}"
                                           class="flex text-base font-normal text-gray-900 dark:text-white hover:text-lime-green-600 dark:hover:text-lime-green-600">
                                            <span class="ml-3">{{ $course->name }}</span>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </aside>
                    </section>
                    <section class="w-3/4 py-5">
                        <div class="container grid place-items-center mx-auto h-64 md:w-4/5 w-11/12 px-6">
                            @foreach($tasks as $task)
                                @if($task->ends_at->isFuture())
                                    <ol class="relative border-l border-gray-200 dark:border-lime-green-700 dark:bg-gray-800 rounded-r">
                                        <li class="mb-15">
                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-lime-green-900">
                                            <svg aria-hidden="true"
                                                 class="w-3 h-3 text-blue-600 dark:text-lime-green-400"
                                                 fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                                                    fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                            <div class="ml-10 mt-4 mr-14">
                                                <a href="{{ route('courses.tasks.show', [$course, $task]) }}"
                                                   class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $task->name }}
                                                </a>
                                                <time
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-lime-green-400">
                                                    {{ $task->starts_at }} - {{ $task->ends_at }}
                                                    <time
                                                        class="mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        ({{ $task->ends_at->diffForHumans() }})
                                                    </time>
                                                </time>
                                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                    {{ $task->short_description }}</p>
                                            </div>
                                        </li>
                                    </ol>
                                    <div
                                        class="block h-14 w-full dark:bg-gray-700 relative border-l border-gray-200 dark:border-lime-green-700">
                                    </div>
                                @endif
                            @endforeach
                            @foreach($tasks as $task)
                                @if($task->ends_at->isPast())
                                    <ol class="relative border-l border-gray-200 dark:border-lime-green-700 dark:bg-gray-800 rounded-r">
                                        <li class="mb-15">
                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-lime-green-900">
                                            <svg aria-hidden="true"
                                                 class="w-3 h-3 text-blue-600 dark:text-lime-green-400"
                                                 fill="currentColor"
                                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
                                                    fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                            <div class="ml-10 mt-4">
                                                <a href="{{ route('courses.tasks.show', [$course, $task]) }}"
                                                   class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-gray-400">
                                                    {{ $task->name }}
                                                </a>
                                                <time
                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-lime-green-700">
                                                    {{ $task->starts_at }} - {{ $task->ends_at }}
                                                    <time
                                                        class="mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-600">
                                                        ({{ $task->ends_at->diffForHumans() }})
                                                    </time>
                                                </time>
                                                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-600">
                                                    {{ $task->short_description }}</p>
                                            </div>
                                        </li>
                                    </ol>
                                    @if(!$tasks->last())
                                        <div
                                            class="block h-14 w-full dark:bg-gray-700 relative border-l border-gray-200 dark:border-lime-green-700">
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                            <div
                                class="block h-14 w-full dark:bg-gray-700">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
