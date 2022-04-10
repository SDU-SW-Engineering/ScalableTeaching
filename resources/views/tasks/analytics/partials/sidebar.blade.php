<aside class="w-56 shrink flex-shrink-0 mr-4">
    <div>
        <ul>
            <li>
                <a href="{{ route('courses.tasks.analytics.index', [$course->id, $task->id]) }}" @class(['flex items-center dark:text-white rounded-md py-2 px-2 dark:hover:bg-gray-800', 'dark:bg-gray-800' => request()->route()->getName() == 'courses.tasks.analytics.index'])>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Overview</span>
                </a>
            </li>
        </ul>
        <hr class="dark:border-gray-500 my-4">
        <h4 class="dark:text-gray-400 text-xs uppercase font-bold mt-4 mb-2">Students and progression</h4>
        <ul>
            <li>
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2 mb-1">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                          <path
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Students</span>
                </a>
                @if($task->correction_type != \App\Models\Enums\CorrectionType::Manual)
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2 mb-1">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                          <path
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Builds</span>
                </a>
                @endif
                <a href="{{ route('courses.tasks.analytics.pushes', [$course->id, $task->id]) }}" @class(["flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2 mb-1",
                                                                                                'dark:bg-gray-800' => request()->route()->getName() == 'courses.tasks.analytics.pushes'])>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Pushes</span>
                </a>
                <a href="{{ route('courses.tasks.analytics.taskCompletion', [$course->id, $task->id]) }}"  @class(['flex items-center dark:text-white rounded-md py-2 px-2 dark:hover:bg-gray-800 mb-1',
                                'dark:bg-gray-800' => request()->route()->getName() == 'courses.tasks.analytics.taskCompletion'])>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Task completion</span>
                </a>
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2 mb-1">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Grades</span>
                </a>
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Downloads</span>
                </a>
            </li>
        </ul>
        <hr class="dark:border-gray-500 my-4">
        <h4 class="dark:text-gray-400 text-xs uppercase font-bold mt-4 mb-2">Grading</h4>
        <ul>
            <li>
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2 mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm ml-1">Grading progress</span>
                </a>
                <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </span>
                    <span class="text-sm ml-1">Delegate tasks</span>
                </a>
            </li>
        </ul>
        <hr class="dark:border-gray-500 my-4">
        <h4 class="dark:text-gray-400 text-xs uppercase font-bold mt-4 mb-2">Settings</h4>
        <ul>
            <a href="{{ route('courses.tasks.analytics.subTasks', [$course->id, $task->id]) }}"  @class(['flex items-center dark:text-white rounded-md py-2 px-2 dark:hover:bg-gray-800 mb-1',
                                'dark:bg-gray-800' => request()->route()->getName() == 'courses.tasks.analytics.subTasks'])>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                <span class="text-sm ml-1">Sub-task</span>
            </a>
            <a href="#" class="flex items-center dark:text-white dark:hover:bg-gray-800 rounded-md py-2 px-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </span>
                <span class="text-sm ml-1">Preferences</span>
            </a>
        </ul>
    </div>
</aside>
