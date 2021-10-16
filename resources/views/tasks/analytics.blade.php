@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-4">
            <x-widget>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                    </svg>
                </x-slot>
                <x-slot name="title">Projects</x-slot>
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
                <x-slot name="title">Completed</x-slot>
                <x-slot name="secondary">{{ number_format($finishedPercent) }}%</x-slot>
                {{ $finishedCount }}
            </x-widget>
            <x-widget>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                              clip-rule="evenodd"/>
                    </svg>
                </x-slot>
                <x-slot name="title">Failed</x-slot>
                <x-slot name="secondary">{{ number_format($failedPercent) }}%</x-slot>
                {{ $failedCount }}
            </x-widget>
            <x-widget>
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                              clip-rule="evenodd"/>
                    </svg>
                </x-slot>
                <x-slot name="title">Builds</x-slot>
                <x-slot name="secondary">{{ $buildsToday }} today</x-slot>
                {{ $buildCount }}
            </x-widget>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <div class="bg-white shadow-lg p-4 rounded-md mt-2 dark:bg-gray-900 border dark:border-gray-800">
                    <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Total Projects Per
                        Day</h3>
                    <div>
                        <line-chart :height="300" :labels="{{ $totalProjectsPerDayGraph->labels()  }}" :data="{{ $totalProjectsPerDayGraph->datasets()  }}"></line-chart>
                    </div>
                </div>
            </div>
            <div>
                <div class="bg-white shadow-lg p-4 rounded-md mt-2 dark:bg-gray-900 border dark:border-gray-800">
                    <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Builds Per Day</h3>
                    <div>
                        <bar-chart :height="300" :labels="{{ $dailyBuildsGraph->labels() }}" :data="{{ $dailyBuildsGraph->datasets()  }}"></bar-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
