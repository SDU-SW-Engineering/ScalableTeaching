<div class="bg-white shadow-lg p-4 rounded-md dark:bg-gray-900 border dark:border-gray-800">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold">Builds Per Day</h3>
        <a class="bg-lime-green-500 text-white text-sm px-2 py-0.5 hover:bg-lime-green-600 transition-colors rounded-md mr-2"
           href="{{ route('courses.tasks.admin.builds', [$course->id, $task->id]) }}">Details</a>
    </div>
    <div>
        <bar-chart :height="300" :labels="{{ $dailyBuildsGraph->labels() }}"
                   :data="{{ $dailyBuildsGraph->datasets()  }}"
                   route="{{ route('courses.tasks.admin.builds', [$course->id, $task->id]) }}"></bar-chart>
    </div>
</div>
