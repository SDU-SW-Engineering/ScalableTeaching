<div class="flex mb-3 justify-between">
    <div class="flex">
        <a href="{{ route('courses.show', [$course->id]) }}"
            @class([
            request()->is('courses/*') && !request()->is('courses/*/*')
                 ?  'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700'
                 : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300',
             'py-2 px-3 rounded-md font-semibold flex items-center'
             ])>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            <span>
                Tasks
            </span>
        </a>
        @unless($course->max_groups == 'none')
            <a href="{{ route('courses.groups.index', $course->id) }}"
                @class([
                request()->is('courses/*/groups')
                     ?  'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700'
                     : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300',
                 'py-2 px-3 rounded-md font-semibold flex items-center'
                 ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>
                Groups
            </span>
            </a>
        @endif
    </div>
    <div class="flex">
        @can('manage', $course)
            <a href="{{ route('courses.grading.index', $course->id) }}"
                @class([
                request()->is('courses/*/grading*')
                     ?  'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700'
                     : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300',
                 'py-2 px-3 rounded-md font-semibold flex items-center mr-1'
                 ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>
                    Grading
                </span>
            </a>
            <a href="{{ route('courses.manage.index', $course->id) }}"
                @class([
                request()->is('courses/*/manage*')
                     ?  'bg-lime-green-100 dark:bg-gray-400 text-lime-green-700 dark:text-gray-100 dark:hover:text-gray-100 hover:text-lime-green-700'
                     : 'text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-gray-300',
                 'py-2 px-3 rounded-md font-semibold flex items-center'
                 ])>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
                <span>
                    Manage
                </span>
            </a>
        @endcan
    </div>
</div>
