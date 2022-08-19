@extends('master')

@section('content')
    <nav class="bg-gray-200 dark:bg-gray-600 relative z-10 dark:border-gray-700 shadow dark:shadow-lg">
        <div class="container px-6 mx-auto py-2">
            <div>
                <nav aria-label="Breadcrumb" class="flex">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="http://localhost:8080" class="text-gray-700 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 inline-flex items-center">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 mr-2.5">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="http://localhost:8080/courses" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Courses</a>
                            </div>
                        </li>
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     class="w-6 h-6 text-gray-400">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span
                                    class="text-gray-400 dark:text-gray-400 ml-1 md:ml-2 text-sm font-medium">Create course</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </nav>
    <div class="px-6 pt-6 container mx-auto">
        <form action="{{ route('courses.store') }}" method="post">
            @csrf
            <div
                class="py-2 px-6 pt-2 lg:max-w-xl container mx-auto flex flex-col shadow-s bg-gray-200 dark:bg-gray-700 rounded-md">
                <label class="px-1 text-sm text-lime-green-700 dark:text-gray-400">
                    Create course
                </label>
                <input type="text" name="course-name" placeholder="course name"
                       class="mb-3 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-400  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
                <button
                    class="flex-shrink-0 bg-transparent hover:bg-lime-green-500 text-lime-green-700 font-semi-bold hover:text-white py-2 px-4 border border-lime-green-500 hover:border-transparent rounded-lg"
                    type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
