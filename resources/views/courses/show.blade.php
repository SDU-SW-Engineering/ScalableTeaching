@extends('master')

@section('content')
    <nav class="bg-gray-100 dark:bg-gray-700 border-b-2 dark:border-lime-green-600">
        <div class="container px-6 py-3 mx-auto md:flex md:justify-between md:items-center" v-scope="{ show: true }">
            <div class="flex justify-between w-full items-center">
                <a href="{{ route('courses.index') }}" class="text-lime-green-700 dark:text-lime-green-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>Go back</a>
                <span class="font-light text-xl text-gray-800 dark:text-white hover:text-gray-700 dark:hover:text-gray-300">{{ $course->name }}</span>
            </div>
        </div>
    </nav>

@endsection
