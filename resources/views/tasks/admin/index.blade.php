@extends('tasks.admin.master')

@section('adminContent')
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

    @if($task->is_publishable)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Total Projects Per
                    Day</h3>
                <div>
                    <line-chart :height="300" :labels="{{ $totalProjectsPerDayGraph->labels()  }}"
                                :data="{{ $totalProjectsPerDayGraph->datasets()  }}"></line-chart>

                </div>
            </div>
            @foreach($task->module_configuration->enabled() as $identifier => $moduleModel)
                    <?php $module = $task->module_configuration->resolveModule($identifier) ?>
                @foreach($module->bigWidgets() as $widget)
                    @include("module-$identifier::Widgets/Big/$widget")
                @endforeach
            @endforeach
        </div>
    @endif
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-md shadow-md">
                    <div
                        class="bg-gray-100 dark:bg-gray-800 min-w-full py-2 pl-6 pr-3 flex justify-between items-center">
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
                    @include('tasks.admin.partials.projectTable')
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
            tippy('.failed-hand-in', {
                content: 'This project was not handed in on time',
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
