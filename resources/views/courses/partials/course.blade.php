<div class="mb-4">
    <div @class([
        'px-8 py-4 mx-auto bg-white shadow-md dark:bg-gray-800',
        'rounded-t-lg' => !isset($cantOpen),
        'rounded-lg' => isset($cantOpen)
        ]) class="">
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-700 dark:text-white">{{ $task['name'] }}</span>
            <span @class([
                    'px-3 py-1 text-sm font-bold text-gray-100 transform rounded',
                    'bg-lime-green-600' => $task['status'] == 'finished',
                    'bg-red-500' => $task['status'] == 'overdue',
                    'bg-gray-500' => $task['status'] == 'active'
                ])>
                @switch($task['status'])
                    @case('finished')
                    Passed
                    @break
                    @case('overdue')
                    Failed
                    @break
                    @case('active')
                    Active
                    @break
                @endswitch
            </span>
        </div>

        <div class="mt-2">
            <p class="mt-2 text-gray-600 dark:text-gray-300 h-12 overflow-hidden overflow-ellipsis">{{ $task['short_description'] }}</p>
        </div>

        <div class="flex items-end justify-between mt-4">
            <div class="flex gap-2 text-lime-green-600 dark:text-lime-green-400 text-sm">
                <div class="flex flex-col">
                    <span class="font-bold">{{ $task->starts_at->toDateString() }}</span>
                    <span class="text-xs text-gray-400">{{ $task->starts_at->toTimeString() }}</span>
                </div>
                -
                <div class="flex flex-col">
                    <span class="font-bold">{{ $task->ends_at->toDateString() }}</span>
                    <span class="text-xs text-gray-400">{{ $task->ends_at->toTimeString() }}</span>
                </div>
            </div>

            <div class="flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                @if ($task->starts_at->isFuture())
                    <span>{{ $task->starts_at->diffForHumans() }}</span>
                @else
                    <span>{{ $task->ends_at->diffForHumans() }}</span>
                @endif
            </div>
        </div>
    </div>
    @isset($cantOpen)
    @else
        <a href="{{ route('courses.tasks.show', [$course->id, $task->id]) }}"
           class="shadow-lg bg-gray-200 dark:bg-gray-500 py-2 dark:text-white text-gray-600 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-400 transition-colors rounded-b-lg flex items-center justify-center">
            Open Task
        </a>
    @endif
</div>
