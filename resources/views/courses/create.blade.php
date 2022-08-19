@extends('master')

@section('content')
    <div class="px-6 pt-6 container mx-auto">
        <form action="{{ route('courses.store') }}" method="post">
            @csrf
            <div class="py-2 px-6 pt-2 lg:max-w-xl container mx-auto flex flex-col shadow-s bg-gray-200 dark:bg-gray-700 rounded-md">
                <label class="px-1 text-sm text-lime-green-700 dark:text-gray-400">
                    Create course
                </label>
                <input type="text" name="course-name" placeholder="course name" class="mb-3 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-400  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                <button class="flex-shrink-0 bg-transparent hover:bg-lime-green-500 text-lime-green-700 font-semi-bold hover:text-white py-2 px-4 border border-lime-green-500 hover:border-transparent rounded-lg" type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
