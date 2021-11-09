@extends('master')

@section('content')
    <section class="bg-gray-800 relative">
        @if(session()->has('error'))
        <div class="bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700 absolute" style="left: 50%; transform: translateX(-50%);" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <nav class="container p-6 mx-auto lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-2xl font-bold text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300"
                       href="#">WebTech</a>
                </div>
                <div class="flex lg:hidden">
                    <button @click="show = !show" type="button"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600"
                            aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div class="flex flex-col mt-4 space-y-2 lg:mt-0 lg:flex-row lg:space-x-16 lg:space-y-0">
                <a class="text-gray-700 dark:text-gray-200 dark:hover:text-lime-green-400 hover:text-lime-green-500"
                   href="{{ route('courses.index') }}">Courses</a>
            </div>
            @auth
                <a class="block px-5 py-2 mt-4 font-medium leading-5 text-center text-white hover:text-white capitalize bg-lime-green-500 rounded-lg lg:mt-0 hover:bg-lime-green-400 lg:w-auto"
                   href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            @else
                Login
            @endauth
        </nav>

        <div class="py-10 md:py-40">
            <div class="container px-6 py-16 mx-auto text-center bg-gray-100 rounded-xl shadow-lg bg-blob "
                 style="background-position: 50% 60%; background-size: cover;">
                <div class="max-w-lg mx-auto">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">Assignment Tracking</h1>
                    <p class="mt-6 text-gray-500 dark:text-gray-300 mb-4">This page keeps track of your assignments and
                        tells you instantly when an assignment has been passed.</p>
                    <a href="{{ route('courses.index') }}"
                       class="px-6 py-2 mt-6 text-sm font-medium leading-5 text-center text-white capitalize bg-lime-green-400 rounded-lg hover:bg-lime-green-300 md:mx-0 md:w-auto focus:outline-none shadow-lg">
                        Get Started Now
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white dark:bg-gray-800">
        <div class="container px-6 py-8 mx-auto">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Assignments and Projects</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">In total, <b
                            class="text-lime-green-400">{{ $assignmentCount  }}</b> assignments have been created with
                        an associated <b class="text-lime-green-400">{{ $projectCount }}</b> projects.</p>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">{{ $buildCount }} Builds</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">During the last month <b
                            class="text-lime-green-400">{{ $buildCount }}</b> builds have run, with an averge run time
                        of <b class="text-lime-green-400">{{ number_format($buildAvg, 2) }}</b> seconds</p>
                </div>

                <div>
                    <svg class="h-8 w-8 text-lime-green-600 dark:text-lime-green-500 stroke-current"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Average Queue Time</h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">Over the last month the average queue time has been
                        <b class="text-lime-green-400">{{ number_format($avgQueue, 2) }}</b> seconds</p>
                </div>
            </div>
        </div>
    </section>
@endsection
