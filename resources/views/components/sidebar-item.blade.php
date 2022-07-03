<a href="{{ route($route, [$task->course_id, $task->id]) }}" @class(['flex mb-1 items-center dark:text-white rounded-md py-2 px-2 dark:hover:bg-gray-800 hover:bg-gray-200', 'dark:bg-gray-800 bg-gray-200' => request()->route()->getName() == $route])>
    {{ $slot }}
    <span class="text-sm ml-1">{{ $name }}</span>
</a>
