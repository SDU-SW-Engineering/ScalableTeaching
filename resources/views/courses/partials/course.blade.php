<div class="mb-4">
    <div class="px-8 py-4 mx-auto bg-white rounded-t-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-700 dark:text-white">{{ $task->name }}</span>
            <span class="px-3 py-1 text-sm font-bold text-gray-100 transform bg-lime-green-600 rounded">
                Completed
            </span>
        </div>

        <div class="mt-2">
            <p class="mt-2 text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim reprehenderit nisi,
                accusamus delectus nihil quis facere in modi ratione libero!</p>
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
                <span>{{ $task->ends_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
    <a href="{{ route('courses.tasks.show', [$course->id, $task->id]) }}"
       class="shadow-lg bg-gray-200 dark:bg-gray-500 py-2 dark:text-white text-gray-600 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-400 transition-colors rounded-b-lg flex items-center justify-center">
        Open Task
    </a>
</div>
