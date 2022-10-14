<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
        role="tablist">
        <li class="mr-2" role="presentation">
            <a href="{{ route('courses.tasks.admin.gradingDelegate', [$course, $task]) }}"
               @class(['inline-block p-4 border-b-2 rounded-t-lg', request()->route()->getName() == 'courses.tasks.admin.gradingDelegate' ? 'text-lime-green-500 border-lime-green-500': 'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:text-gray-200']) id="profile-tab"
               data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                Overview
            </a>
        </li>
        @foreach($task->delegations as $delegated)
            <li class="mr-2" role="presentation">
                <a href="{{ route('courses.tasks.admin.showDelegation', [$course, $task, $delegated]) }}"
                   @class(['inline-block p-4 border-b-2 rounded-t-lg', request()->is('*admin/feedback/' . $delegated->id) == 'courses.tasks.admin.gradingDelegate' ? 'text-lime-green-500 border-lime-green-500': 'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:text-gray-200' ]) id="profile-tab"
                   id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                   aria-selected="false">{{ $delegated->course_role_id == 1 ? 'Student' : 'Teacher' }} Delegation
                </a>
            </li>
        @endforeach
    </ul>
</div>
