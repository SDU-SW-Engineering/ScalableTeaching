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
    <div class="bg-gray-100 dark:bg-gray-700">
        <div class="container mx-auto px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($courses as $course)
                <div
                    class="shadow-lg hover:shadow-xl rounded-xl p-4 bg-white relative overflow-hidden dark:bg-gray-800">
                    <a href="{{ route('courses.show', [$course['id']]) }}" class="w-full h-full block">
                        <div class="w-full">
                            <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                                {{ $course['name'] }}
                            </p>
                            @unless($course['next_deadline'] == null)
                                <p class="text-lime-green-600 text-xs font-medium mb-2">
                                    Next Due Date: <b>{{ $course['next_deadline']->toFormattedDateString() }}
                                        , {{ $course['next_deadline']->diffForHumans() }}</b>
                                </p>
                            @endunless
                        </div>
                        <div class="flex items-center justify-between my-2">
                            <p class="text-gray-300 text-sm">
                                @if ($course['taskCount'] == 0)
                                    0
                                @else
                                    {{ $course['completed'] }}/{{ $course['taskCount'] }}
                                @endif
                                task completed
                            </p>
                        </div>
                        <div class="w-full h-2 bg-lime-green-200 rounded-full">
                            <div
                                style="width: {{ $course['taskCount'] == 0 ? 0 : number_format($course['completed'] / $course['taskCount'] * 100, 2) }}%"
                                class="h-full text-center text-xs text-white bg-lime-green-600 rounded-full">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
