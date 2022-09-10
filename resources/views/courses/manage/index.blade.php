@extends('courses.manage.master')

@section('manageContent')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
        <x-widget>
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
            </x-slot>
            <x-slot name="title">Projects</x-slot>
            <x-slot name="secondary">22 today</x-slot>
            44
        </x-widget>
        <x-widget>
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
            </x-slot>
            <x-slot name="title">Projects</x-slot>
            <x-slot name="secondary">22 today</x-slot>
            44
        </x-widget>
        <div class="w-full col-span-2">
            <div class="flex shadow-lg bg-gray-200 dark:bg-gray-800 rounded-md px-5 py-5">
                <div
                    class="flex w-10 h-10 bg-lime-green-200 justify-center items-center rounded-lg text-lime-green-800 mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                </div>
                <div class="flex flex-col flex-grow -mt-1">
                    <span class="-mb-1 text-sm font-semibold text-gray-500 dark:text-gray-400">Enrollment</span>
                    <p class="text-gray-500 dark:text-white mb-1 mt-0.5 text-xs">You can share the link below to let students join the
                        course.</p>
                    <input type="text" id="groupname" readonly
                           value="{{ route('courses.enroll', [$course->id, 'token' => $course->enroll_token]) }}"
                           class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 text-xs
                           flex-grow border border-gray-300 text-gray-900 rounded-lg focus:outline-none block w-full p-2 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"
                    >
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
            <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Enrolment</h3>
            <div>
                <line-chart :height="300" :labels="{{ $enrolmentGraph->labels()  }}"
                            :data="{{ $enrolmentGraph->datasets()  }}"></line-chart>

            </div>
        </div>
        <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
            <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Exercise Engagement</h3>
            <div>
                <bar-chart :display-categories="true" :height="300" :labels="{{ $userEngagementGraph->labels() }}"
                           :data="{{ $userEngagementGraph->datasets()  }}"></bar-chart>
            </div>
        </div>
    </div>
@endsection
