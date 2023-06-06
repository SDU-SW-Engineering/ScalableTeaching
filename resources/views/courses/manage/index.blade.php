@extends('courses.manage.master')

@section('manageContent')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
            <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Enrolment</h3>
            <div>
                <line-chart :height="300" :labels="{{ $enrolmentGraph->labels()  }}"
                            :data="{{ $enrolmentGraph->datasets()  }}"></line-chart>

            </div>
        </div>
        <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
            <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Task Engagement</h3>
            @if($userEngagementGraph == null)
                <div class="flex items-center justify-center h-full">
                    <h2>Not enough data to create graph.</h2>
                </div>
            @else
                <div>
                    <bar-chart :display-categories="true" :height="300" :labels="{{ $userEngagementGraph->labels() }}"
                               :data="{{ $userEngagementGraph->datasets()  }}"></bar-chart>
                </div>
            @endif
        </div>
    </div>
@endsection
