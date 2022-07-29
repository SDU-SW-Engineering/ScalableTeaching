<div>
    <div @class([
        'px-8 py-4 mx-auto bg-white shadow-md dark:bg-gray-600',
        'rounded-t-lg' => !isset($cantOpen),
        'rounded-lg' => isset($cantOpen)
        ]) class="">
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-700 dark:text-white">{{ $task['details']['name'] }}</span>
            @if($task['details']->grade() != null)
                <span @class([
                    'px-3 py-1 text-sm font-bold text-gray-100 transform rounded',
                    'bg-lime-green-600' => $task['details']->grade()->value == \App\Models\Enums\GradeEnum::Passed,
                    'bg-red-500' => $task['details']->grade()->value == \App\Models\Enums\GradeEnum::Failed,
                ])>
                    @switch($task['details']->grade()->value)
                        @case(\App\Models\Enums\GradeEnum::Passed)
                        Passed
                        @break
                        @case(\App\Models\Enums\GradeEnum::Failed)
                        Failed
                        @break
                        @default
                    @endswitch
                </span>
            @endif

        </div>

        <div class="mt-2">
            <p class="mt-2 text-gray-600 dark:text-gray-300 h-12 overflow-hidden overflow-ellipsis">{{ $task['details']['short_description'] }}</p>
        </div>

        <div class="flex items-end justify-between mt-4">
            <div class="flex gap-2 text-lime-green-600 dark:text-lime-green-400 text-sm">
                <div class="flex flex-col">
                    <span class="font-bold">{{ $task['details']->starts_at->toDateString() }}</span>
                    <span class="text-xs text-gray-400">{{ $task['details']->starts_at->toTimeString() }}</span>
                </div>
                -
                <div class="flex flex-col">
                    <span class="font-bold">{{ $task['details']->ends_at->toDateString() }}</span>
                    <span class="text-xs text-gray-400">{{ $task['details']->ends_at->toTimeString() }}</span>
                </div>
            </div>

            <div class="flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                @if ($task['details']->starts_at->isFuture())
                    <span>{{ $task['details']->starts_at->diffForHumans() }}</span>
                @else
                    <span>{{ $task['details']->ends_at->diffForHumans() }}</span>
                @endif
            </div>
        </div>
    </div>
    @canany(['view-analytics', 'update'], $task['details'])
        <div class="bg-gray-100 dark:bg-gray-500 flex px-8 py-2 gap-2">
            @can('view-analytics', $task['details'])
                <a href="{{ route('courses.tasks.admin.index', [$course->id, $task['details']->id]) }}"
                   class="flex items-cente px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-300 dark:bg-gray-600 rounded-md text-gray-700 dark:text-white dark:hover:bg-gray-700 hover:bg-gray-200 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                </a>
            @endcan
            @can('manage', $course)
                <a href="{{ route('courses.manage.editTask', [$course->id, $task['details']->id]) }}"
                   class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-300 dark:bg-gray-600 rounded-md text-gray-700 dark:text-white dark:hover:bg-gray-700 hover:bg-gray-200 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                </a>
            @endcan
        </div>
    @endcanany
    @isset($cantOpen)
    @else
        <a href="{{ route('courses.tasks.show', [$course->id, $task['details']->id]) }}"
           class="shadow-lg bg-gray-200 dark:bg-gray-800 py-2 dark:text-white text-gray-600 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors rounded-b-lg flex items-center justify-center">
            Open Task
        </a>
    @endif
</div>
