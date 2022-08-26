@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="flex mb-4 justify-between items-center">
            <h1 class="text-4xl font-thin">{{ $course->name }}</h1>
            <div>
                <div class="flex items-center">
                    <div class="mr-20 flex gap-20">
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-lime-green-600 -mb-2 text-3xl font-bold">{{ $course->members->count() }}</span>
                            <span class="font-thin text-lg">students</span>
                        </div>
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-lime-green-600 -mb-2 text-3xl font-bold">{{ $course->projects->count() }}</span>
                            <span class="font-thin text-lg">projects</span>
                        </div>
                    </div>
                    <div class="">
                        <button class="flex bg-lime-green-400 text-white text-sm py-1.5 px-2 rounded hover:bg-lime-green-500 transition-colors">
                            <span class="mr-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                </svg>
                            </span>
                            <span>Copy Enrollment URL</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            @include('courses.manage.partials.sidebar')
            <div class="flex-grow-1 w-full bg-white shadow p-4 rounded-lg">
                @yield('manageContent')
            </div>
        </div>
    </div>
@endsection
