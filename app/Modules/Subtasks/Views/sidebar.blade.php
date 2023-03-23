<x-sidebar-group name="Progression">
    <x-sidebar-item name="Task completion" route="courses.tasks.admin.taskCompletion"
                    :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
        </svg>
    </x-sidebar-item>
    <x-sidebar-item name="Subtasks" route="courses.tasks.admin.subTasks" :route-params="[$course, $task]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
        </svg>
    </x-sidebar-item>
</x-sidebar-group>
