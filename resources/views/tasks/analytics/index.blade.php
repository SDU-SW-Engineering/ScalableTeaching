@extends('tasks.analytics.master')

@section('analyticsContent')

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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Total Projects Per
                    Day</h3>
                <div>
                    <line-chart :height="300" :labels="{{ $totalProjectsPerDayGraph->labels()  }}"
                                :data="{{ $totalProjectsPerDayGraph->datasets()  }}"></line-chart>
                </div>
            </div>
            <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold">Builds Per Day</h3>
                    <a class="bg-lime-green-500 text-white text-sm px-2 py-0.5 hover:bg-lime-green-600 transition-colors rounded-md mr-2"
                       href="{{ route('courses.tasks.analytics.builds', [$course->id, $task->id]) }}">Details</a>
                </div>
                <div>
                    <bar-chart :height="300" :labels="{{ $dailyBuildsGraph->labels() }}"
                               :data="{{ $dailyBuildsGraph->datasets()  }}"
                               route="{{ route('courses.tasks.analytics.builds', [$course->id, $task->id]) }}"></bar-chart>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden sm:rounded-md shadow-md">
                        <div
                            class="bg-gray-50 dark:bg-gray-800 min-w-full py-2 pl-6 pr-3 flex justify-between items-center">
                            <h2 class="text-lg  dark:text-gray-200">Projects</h2>
                            <div class="flex items-center">
                                <!--<form>
                                    <input type="text" autocomplete="off"
                                           class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-800 text-gray-900 dark:text-gray-100 text-xs rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 mr-2"
                                           placeholder="Filter" required>
                                </form>-->
                                <a href="{{ request()->url() }}?status=finished"
                                    @class([
                                            'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'finished',
                                            'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'finished'
                                        ])
                                >Completed</a>
                                <a href="{{ request()->url() }}?status=active"
                                    @class([
                                            'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'active',
                                            'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'active'
                                        ])
                                >
                                    Active
                                </a>
                                <a href="{{ request()->url() }}"
                                    @class([
                                            'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md' => request()->get('status','all') == 'all',
                                            'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status', 'all') != 'all'
                                        ])
                                >
                                    All
                                </a>
                            </div>
                        </div>
                        <table class="min-w-full">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                    Users
                                </th>
                                <th scope="col"
                                    class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                    <a class="flex items-center"
                                       href="{{ request()->fullUrlWithQuery(['sort' => 'job_statuses_count', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                        @if (request('sort') == 'job_statuses_count')
                                            @if (request('direction') == 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
                                                </svg>
                                            @endif
                                        @endif
                                        <span>Builds</span>
                                    </a>
                                </th>
                                <th scope="col"
                                    class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                    Status
                                </th>
                                @if(request('status') == 'finished')
                                    <th class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                        Finished
                                    </th>
                                    <th scope="col"
                                        class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                        <a class="flex items-center justify-end"
                                           href="{{ request()->fullUrlWithQuery(['sort' => 'duration', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                            @if (request('sort') == 'duration')
                                                @if (request('direction') == 'asc')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                                         viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
                                                    </svg>
                                                @endif
                                            @endif
                                            <span>Duration</span>
                                        </a>
                                    </th>
                                @endif
                                <th class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                    Created at
                                </th>
                                <th scope="col"
                                    class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr class="bg-white dark:bg-gray-600 border-b dark:border-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                        @if($project->ownable_type == \App\Models\User::class)
                                            {{ $project->ownable->name }}
                                        @elseif($project->ownable_type == \App\Models\Group::class)
                                            {{ $project->ownable->name }} <span
                                                class="text-gray-400">({{ $project->ownable->memberString }})</span>
                                        @else
                                            {{ $project->repo_name }}
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                                        {{ $project->pipelines->count() }}
                                    </td>
                                    <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap">
                                        @if($project->status == \App\ProjectStatus::Active)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-6 w-6 active text-yellow-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-6 w-6 text-lime-green-300 handed-in mr-2"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                @if($project->validationStatus == 'pending')
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-6 w-6 waiting-for-verification" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                @elseif($project->validationStatus == 'success')
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-6 w-6 text-lime-green-400 validated-success"
                                                         fill="none" viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 validated-failed" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    @if(request('status') == 'finished')
                                        <td class="text-sm text-gray-500 dark:text-gray-300 px-6 py-4 whitespace-nowrap">
                                            {{ $project->finished_at->diffForHumans() }}
                                        </td>
                                        <td class="text-sm text-gray-500 dark:text-gray-200 px-6 py-4 whitespace-nowrap text-right">
                                            {{ $project->duration }} days
                                        </td>
                                    @endif
                                    <td class="text-sm text-gray-500 dark:text-gray-300 px-6 py-4 whitespace-nowrap">
                                        {{ $project->created_at->diffForHumans() }}
                                    </td>
                                    <td class="w-px">
                                        <div class="flex mr-3">
                                            <a type="button"
                                               href="{{ route('courses.tasks.showProject', [$course->id, $task->id, $project->id]) }}"
                                               class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-l-lg text-xs px-3 py-2 text-center">Open</a>
                                            @if($project->status == 'finished')
                                                <a type="button"
                                                   href="{{ route('courses.tasks.downloadProject', [$course->id, $task->id, $project->id]) }}"
                                                   class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium text-xs px-3 py-2 text-center">Download</a>
                                            @else
                                                <a type="button"
                                                   class="text-white not-done bg-gray-500 cursor-not-allowed font-medium text-xs px-3 py-2 text-center">Download</a>
                                            @endif
                                            @if($project->status == 'finished')
                                                <a type="button"
                                                   href="{{ route('courses.tasks.validateProject', [$course->id, $task->id, $project->id]) }}"
                                                   class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-r-lg text-xs px-3 py-2 text-center">Validate</a>
                                            @else
                                                <a type="button"
                                                   class="text-white cant-validate bg-gray-500 cursor-not-allowed font-medium rounded-r-lg text-xs px-3 py-2 text-center">Validate</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <div class="py-2 px-3">
                            {{ $projects->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
