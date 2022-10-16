@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="flex mb-4 justify-between items-center">
            <h1 class="text-4xl dark:text-white font-thin">{{ $task->name }}</h1>
            <div>
                <div class="flex items-center">
                    <div class="mr-20 flex gap-20">

                        <div class="flex items-center justify-center flex-col">
                            <span
                                class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $task->projects->count() }}</span>
                            <span class="font-thin text-lg dark:text-gray-300">projects</span>
                        </div>
                        <div class="flex items-center justify-center flex-col">
                            <span
                                class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $task->jobs->count() }}</span>
                            <span class="font-thin text-lg dark:text-gray-300">builds</span>
                        </div>
                        @if($commentCount > 0)
                            <div class="flex items-center justify-center flex-col">
                                <span
                                    class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $commentCount }}</span>
                                <span class="font-thin text-lg dark:text-gray-300">comments</span>
                            </div>
                        @endif
                    </div>
                    <visibility-dropdown route="{{ route('courses.tasks.admin.toggle-visibility', [$course, $task]) }}"
                                         :is-visible="{{ $task->is_visible ? 'true' : 'false' }}"
                                         :is-publishable="{{ $task->is_publishable ? 'true' : 'false' }}"></visibility-dropdown>
                    <a href="{{ route('courses.tasks.show', [$course, $task]) }}" target="_blank"
                       class="flex items-center bg-white hover:bg-gray-50 dark:bg-gray-600 text-gray-500 font-medium dark:text-gray-200 dark:border-none dark:hover:bg-gray-500 transition-colors ml-3 text-sm border rounded-lg px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="w-5 h-5 mr-2">
                            <path fill-rule="evenodd"
                                  d="M15.75 2.25H21a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0V4.81L8.03 17.03a.75.75 0 01-1.06-1.06L19.19 3.75h-3.44a.75.75 0 010-1.5zm-10.5 4.5a1.5 1.5 0 00-1.5 1.5v10.5a1.5 1.5 0 001.5 1.5h10.5a1.5 1.5 0 001.5-1.5V10.5a.75.75 0 011.5 0v8.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V8.25a3 3 0 013-3h8.25a.75.75 0 010 1.5H5.25z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="mt-0.5">Show Task</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex">
            @include('tasks.admin.partials.sidebar')
            <div class="flex-grow-1 w-full">
                @yield('adminContent')
            </div>
        </div>
    </div>
@endsection
