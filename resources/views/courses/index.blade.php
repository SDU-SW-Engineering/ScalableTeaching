@extends('master')

@section('content')
    <div class="bg-lime-green-500">
        <div class="container mx-auto px-6 py-12">
            <h1 class="text-3xl font-bold text-gray-100 dark:text-gray-100">Courses</h1>
            <h2 class="text-lime-green-100 dark:text-lime-green-900 font-light">Currently enrolled in <b>%</b> courses
            </h2>
        </div>
    </div>
    <div class="bg-gray-100 dark:bg-gray-700">
        <div class="container mx-auto px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($courses as $course)
                <div class="shadow-lg hover:shadow-xl rounded-xl p-4 bg-white relative overflow-hidden dark:bg-gray-800">
                    <a href="{{ route('courses.show', [$course->id]) }}" class="w-full h-full block">
                        <div class="w-full">
                            <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                                Improve css design of the carousel
                            </p>
                            <p class="text-lime-green-600 text-xs font-medium mb-2">
                                Next Due Date: Sunday, 23 August
                            </p>
                            <p class="text-gray-400 text-sm mb-4 h-16 overflow-hidden overflow-ellipsis">
                                You’ve been coding for a while now and know your way around...sdasfasdf asdfasd sadfas fasdf  asdfasdfasdfdsfasdfasdfasdf asdfasdfasdfsaadasdfas asdf asdf asdfasf
                            </p>
                        </div>
                        <div class="flex items-center justify-between my-2">
                            <p class="text-gray-300 text-sm">
                                1/3 task completed
                            </p>
                        </div>
                        <div class="w-full h-2 bg-lime-green-200 rounded-full">
                            <div class="w-2/3 h-full text-center text-xs text-white bg-lime-green-600 rounded-full">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
