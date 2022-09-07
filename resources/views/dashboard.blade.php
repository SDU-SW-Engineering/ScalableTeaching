@extends('master')

@section('content')
    <div class="w-64 absolute sm:relative bg-gray-800 shadow md:h-full flex-col justify-between hidden sm:flex">
        <aside class="w-64" aria-label="Sidebar">
            <a href="http://localhost:8080/courses" class="flex items-center pl-2.5 mb-2">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-lime-green-500">Courses</span>
            </a>
            @foreach($courses as $course)
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('courses.show', [$course['id']]) }}"
                           class="flex text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3">{{ $course['name'] }}</span>
                        </a>
                    </li>
                </ul>
            @endforeach
        </aside>
    </div>
    <div class="container grid place-items-center mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
        <ol class="relative border-l border-gray-200 dark:border-lime-green-700">
                <li class="mb-10 ml-6">
        <span
            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-lime-green-900">
            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-lime-green-400" fill="currentColor"
                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
                                                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                                              clip-rule="evenodd"></path></svg>
        </span>
                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Flowbite
                        Application UI v2.0.0 <span
                            class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">Latest</span>
                    </h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Released
                        on January 13th, 2022
                    </time>
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Get access to over 20+ pages
                        including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce &
                        Marketing pages.</p>
                    <a href="#"
                       class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Download ZIP</a>
                </li>
                <li class="mb-10 ml-6">
        </ol>
    </div>
@endsection
