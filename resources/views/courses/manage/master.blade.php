@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="flex mb-4 justify-between items-center">
            <h1 class="text-4xl dark:text-white font-thin">{{ $course->name }}</h1>
            <div>
                <div class="flex items-center">
                    <div class="mr-20 flex gap-20">
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $course->students->count() }}</span>
                            <span class="font-thin text-lg dark:text-gray-300">students</span>
                        </div>
                        @if($course->projects->count() > 0)
                            <div class="flex items-center justify-center flex-col">
                                <span class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $course->projects->count() }}</span>
                                <span class="font-thin text-lg dark:text-gray-300">submissions</span>
                            </div>
                        @endif
                        @if($course->tasks()->count() > 0)
                            <div class="flex items-center justify-center flex-col">
                                <span class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $course->tasks()->count() }}</span>
                                <span class="font-thin text-lg dark:text-gray-300">tasks</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            @include('courses.manage.partials.sidebar')
            <div class="flex-grow-1 w-full">
                @yield('manageContent')
            </div>
        </div>
    </div>
@endsection

@section('breadcrumbs-bar')
    <enrollment-url url="{{ route('courses.enroll', [$course, 'token' => $course->enroll_token]) }}"></enrollment-url>
@endsection
