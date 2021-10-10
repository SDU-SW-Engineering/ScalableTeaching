@extends('master')

@section('content')
    <nav class="bg-gray-100 dark:bg-gray-700 border-b-4 border-lime-green-300 dark:border-lime-green-600">
        <div class="container px-6 py-3 mx-auto md:flex md:justify-between md:items-center" v-scope="{ show: true }">
            <div class="flex justify-between w-full items-center">
                <a href="{{ route('courses.index') }}" class="text-lime-green-700 hover:text-lime-green-300 dark:text-lime-green-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>Go back</a>
                <span class="font-light text-xl text-gray-800 dark:text-white hover:text-gray-700 dark:hover:text-gray-300">{{ $course->name }}</span>
            </div>
        </div>
    </nav>
    <div class="px-6 pt-4 container">
        <div class="flex gap-6">
            <div class="w-2/3">
                <div class="mb-4">
                    <h2 class="text-xl mb-1 dark:text-gray-200">In progress</h2>
                    <hr class="w-full h-0.5 bg-gray-300 dark:bg-gray-500 rounded">
                </div>

                <div>
                    <div class="max-w-2xl px-8 py-4 mx-auto bg-white rounded-t-lg shadow-md dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-gray-700 dark:text-white">Towards ItsLearning</span>
                            <span class="px-3 py-1 text-sm font-bold text-gray-100 transform bg-lime-green-600 rounded">
                                Completed
                            </span>
                        </div>

                        <div class="mt-2">
                            <p class="mt-2 text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lime-green-600 dark:text-lime-green-400 flex items-center">
                                <b class="mr-2">10-08-21</b> - <b class="ml-2">21-08-2021</b>
                            </span>

                            <div class="flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>2 days and 22 hours left</span>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="shadow-lg bg-gray-200 dark:bg-gray-500 py-2 dark:text-white text-gray-600 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-400 transition-colors rounded-b-lg flex items-center justify-center">
                       Open Task
                    </a>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
@endsection
