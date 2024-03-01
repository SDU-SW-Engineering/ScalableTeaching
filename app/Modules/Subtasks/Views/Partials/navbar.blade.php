<div class="mb-4 h-12 justify-between flex">
    <div class="flex gap-4">
        <a href="{{ route('courses.tasks.admin.subtasks.task-completion', [$course, $task]) }}"
           @class([
                'flex items-center font-medium  transition-colors text-sm rounded-lg px-4 py-3 gap-2',
                request()->is('*/modules/subtasks/task-completion') ? 'bg-lime-green-200 text-lime-green-800 hover:bg-lime-green-300' : 'bg-white hover:bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-200 dark:hover:bg-gray-500'
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path
                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"/>
            </svg>
            <span>Student Overview</span>
        </a>
        <a href="{{ route('courses.tasks.admin.subtasks.aggregate-task-completion', [$course, $task]) }}"
           @class([
                'flex items-center font-medium  transition-colors text-sm rounded-lg px-4 py-3 gap-2',
                request()->is('*/modules/subtasks/task-completion/aggregate') ? 'bg-lime-green-200 text-lime-green-800 hover:bg-lime-green-300' : 'bg-white hover:bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-200 dark:hover:bg-gray-500'
            ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path
                    d="M6 21H3a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v17a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1z"></path>
            </svg>
            <span>Aggregate data</span>
        </a>
    </div>
    <div class="h-full flex">
        <a href="{{ route('courses.tasks.admin.subtasks.export', [$course, $task]) }}"
           class="flex items-center font-medium  transition-colors text-sm rounded-lg px-4 py-3 gap-2 bg-white hover:bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-200 dark:hover:bg-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path
                    d="M18 22a2 2 0 0 0 2-2v-5l-5 4v-3H8v-2h7v-3l5 4V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12zM13 4l5 5h-5V4z"></path>
            </svg>
            <span>Export</span>
        </a>
    </div>
</div>
