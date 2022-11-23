@extends('tasks.admin.master')

@section('adminContent')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-4">
        <x-widget>
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                </svg>
            </x-slot>
            <x-slot name="title">Tasks</x-slot>
            <x-slot name="secondary">{{ $projectsToday }} today</x-slot>
            {{ $projectCount }}
        </x-widget>
        <x-widget>
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot>
            <x-slot name="title">Visits</x-slot>
            <x-slot name="secondary">{{ $visitorsToday }} today</x-slot>
            {{ $visitorCount }}
        </x-widget>
        <x-widget>
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd"/>
                </svg>
            </x-slot>
            <x-slot name="title">Completed</x-slot>
            <x-slot name="secondary">{{ number_format($finishedPercent) }}%</x-slot>
            {{ $finishedCount }}
        </x-widget>
    </div>

    @if($task->is_publishable)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Total Projects Per
                    Day</h3>
                <div>
                    <line-chart :height="400" :labels="{{ $totalProjectsPerDayGraph->labels()  }}"
                                :data="{{ $totalProjectsPerDayGraph->datasets()  }}"></line-chart>

                </div>
            </div>
            <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Total Visitors Per
                    Day</h3>
                <div>
                    <bar-chart :height="400" :labels="{{ $totalVisitsPerDayGraph->labels()  }}"
                                :data="{{ $totalVisitsPerDayGraph->datasets()  }}"></bar-chart>

                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            tippy('.active', {
                content: 'This project is still in progress',
            });
            tippy('.handed-in', {
                content: 'This project has been handed in',
            });
            tippy('.waiting-for-verification', {
                content: 'Waiting for validation'
            });
            tippy('.not-done', {
                content: 'Can\'t download before assignment has been handed in.'
            });
            tippy('.cant-validate', {
                content: 'Can\'t validate before assignment has been handed in.'
            });
            tippy('.validated-success', {
                content: 'This project has been successfully validated, an no issues were found.'
            });
            tippy('.validated-failed', {
                content: 'This project has failed validation, see the log for more information.'
            });
        });
    </script>
@endsection
