@extends('master')

@section('content')
    <div class="flex gap-x-20 px-16 pt-10">
        <div class="flex-auto w-1/2">
            <div class="rounded-lg shadow bg-gray-800 place-items-center">
                <div class="px-10 pt-5">
                    <h1 class="text-white text-lg font-semibold">
                        Active courses
                    </h1>
                </div>
                <div class="pb-5 px-10">
                    @foreach($courses as $course)
                        <ol>
                            <li>
                                <a href="{{ route('courses.show', $course) }}"
                                   class="flex items-center mb-1 text-gray-900 dark:text-white">
                                    {{ $course->name }}
                                </a>
                            </li>
                        </ol>
                    @endforeach
                </div>
            </div>
            <div class="overflow-auto h-1/4 mt-10 mb-5 pb-3 rounded-lg shadow bg-gray-800 place-items-center">
                <div class="px-10 pt-5">
                    <h1 class="text-white text-lg font-semibold">
                        Active assignments
                    </h1>
                </div>
                @foreach($tasks as $task)
                    @if($task->ends_at->isFuture())
                        <ol>
                            <li class="m-10 mt-5 bg-gray-750 rounded-lg">
                                <div class="m-5">
                                    <a href="{{ route('courses.tasks.show', [$task->course_id, $task]) }}"
                                       class="flex items-center mb-1 mt-5 text-lg font-semibold text-gray-900 dark:text-white">
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
                                        {{ Str::words($task->description, 50) }}</p>
                                </div>
                            </li>
                        </ol>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex-auto w-1/2">
            <div class="flex flex-col pb-5 rounded-lg bg-gray-800">
                <h1 class="text-white text-lg font-semibold ml-10 mt-5">
                    Upcoming deadline
                </h1>
                <a href="{{ route('courses.tasks.show', [$tasks->first()->course_id, $tasks->first()]) }}"
                   class="flex items-center mb-1 mt-3 text-gray-900 dark:text-white ml-10">
                    {{ $tasks->first()->name }}
                </a>
                <a href="{{ route('courses.show', $tasks->first()->course_id) }}"
                   class="flex items-center mb-1 text-gray-900 dark:text-white ml-10">
                    {{ $courses[$tasks->first()->course_id]->name }}
                </a>
                <time
                    class="text font-normal leading-none text-gray-400 dark:text-lime-green-400 ml-10">
                    Due {{ $tasks->first()->ends_at->diffForHumans() }}
                </time>
            </div>
            <div class="flex flex-col mb-10 mt-10 rounded-lg bg-gray-800">
                <div class="mt-5 mb-5 ml-10 text-lg font-medium dark:text-white">
                    Progress bar
                </div>
                @foreach($courses as $course)
                    <a href="{{ route("courses.show", $course) }}"
                       class="ml-10 font-medium dark:text-white">
                        {{ $course->name }}
                    </a>
                    <div class="mb-5 ml-10 mr-10 w-7/8 h-6 bg-gray-200 rounded-full dark:bg-gray-700">
                        <div class="h-6 bg-blue-600 rounded-full dark:bg-lime-green-600" style="width: 33.36%"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
