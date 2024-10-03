@php use App\Models\Course; @endphp
@extends('master')

@section('content')
    <div class="bg-lime-green-500">
        <div class="container mx-auto px-6 py-12">
            <h1 class="text-3xl font-bold text-gray-100 dark:text-gray-100">Courses</h1>
            <h2 class="text-lime-green-100 dark:text-lime-green-900 font-light">Currently enrolled in
                <b>{{ $courses->count() }}</b> course(s)
            </h2>
        </div>
    </div>
    <div class="container mx-auto px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
        @can('create', Course::class)
            <a class="bg-lime-green-100 text-lime-green-800 rounded-xl border border-lime-green-300 shadow hover:shadow-md flex flex-col items-center justify-center"
               href="{{ route("courses.create") }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Create course</span>
            </a>
        @endcan
        @foreach($courses as $course)
            <div
                class="shadow hover:shadow-md border dark:border-gray-800 rounded-xl p-4 bg-white relative overflow-hidden dark:bg-gray-800">
                <a href="{{ route('courses.show', [$course['id']]) }}"
                   class="w-full h-full block flex flex-col justify-between">
                    <div class="w-full">
                        <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                            {{ $course['name'] }}
                        </p>
                        @unless($course['next_deadline'] == null)
                            @if ($course['next_deadline']->isFuture())
                                <p class="text-lime-green-600 text-xs font-medium mb-2">
                                    Next Due Date: <b>{{ $course['next_deadline']->toFormattedDateString() }}
                                        , {{ $course['next_deadline']->diffForHumans() }}</b>
                                </p>
                            @else
                                <p class="text-lime-green-600 text-xs font-medium mb-2">
                                    No upcoming tasks.
                                </p>
                            @endif
                        @endunless
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-400 mt-2 text-sm">
                                {{ $course['taskCount'] }} tasks
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
