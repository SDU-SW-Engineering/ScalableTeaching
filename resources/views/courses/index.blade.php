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
        @foreach($courses as $course)
            <div
                class="shadow-lg hover:shadow-xl border dark:border-gray-800 rounded-xl p-4 bg-white relative overflow-hidden dark:bg-gray-800">
                <a href="{{ route('courses.show', [$course['id']]) }}" class="w-full h-full block flex flex-col justify-between">
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
