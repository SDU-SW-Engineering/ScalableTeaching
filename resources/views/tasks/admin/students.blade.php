@php use App\ProjectStatus; @endphp
@extends('tasks.admin.master')

@section('adminContent')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button
                    @class(['inline-block p-4 border-b-2 rounded-t-lg', 'text-lime-green-500 border-lime-green-500']) id="profile-tab"
                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Students
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Groups
                </button>
            </li>
        </ul>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-600 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span>Name</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Student ID</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Group</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Project</span>
                </th>
                <th scope="col" class="px-6 py-3 flex justify-end">
                    <span>Actions</span>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($students as $student)
                @php($project = $student->projects()->where('task_id', $task->id)->first())
                <tr
                    class=" border-b {{ $loop->index % 2 == 0 ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }} dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $student->name }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $student->username }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if($student->groups()->where('course_id', $course->id)->first())
                            <a href="{{route("courses.manage.groups.show", [$course, $student->groups()->where('course_id', $course->id)->first()])}}">{{ $student->groups()->where('course_id', $course->id)->first()->name}}</a>
                        @else
                            <p class="text-gray-600 whitespace-nowrap dark:text-gray-400">Not member of a group</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if($project)
                            <a href="{{route("courses.tasks.showProject", [$course, $task, $project])}}">{{ $project->repo_name}}</a>
                        @else
                            <p class="text-gray-600 whitespace-nowrap dark:text-gray-400">Not Started</p>
                        @endif
                    </td>

                    @if($project)
                        <td class="flex px-6 py-4 gap-2 justify-end align-items-center">
                            @if($task->isCodeTask() && $project->status == ProjectStatus::Active)
                                <a href="{{route("projects.reset", [$project])}}"
                                   class="text-sm flex items-center bg-red-700 hover:bg-red-800 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bi bi-trash" fill="currentColor"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    <span class="text-sm m-1">Reset</span>
                                </a>
                            @else
                                <a class="text-sm flex items-center bg-gray-600 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bi bi-trash" fill="currentColor"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    <span class="text-sm m-1">Reset</span>
                                </a>
                            @endif
                            <a href="{{route("courses.tasks.admin.linkRepository.redirect.repository", [$course, $task, $project])}}"
                               target="_blank"
                               class="text-sm flex items-center bg-blue-800 hover:bg-blue-900 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                <span class="text-sm m-1">Open Repository</span>
                            </a>
                            <a href="{{route("courses.tasks.showProject", [$course, $task, $project])}}"
                               target="_blank"
                               class="text-sm flex items-center bg-lime-green-500 hover:bg-lime-green-600 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm m-1">Open Task</span>
                            </a>
                        </td>
                    @else
                        <td class="flex px-6 py-4 gap-2 justify-end align-items-center">
                            <a class="text-sm flex items-center bg-gray-600 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 bi bi-trash" fill="currentColor"
                                     viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                <span class="text-sm m-1">Reset</span>
                            </a>
                            <a class="text-sm flex items-center bg-gray-600 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                <span class="text-sm m-1">Open Repository</span>
                            </a>
                            <a class="text-sm flex items-center bg-gray-600 transition-colors text-gray-100 py-1 px-1 rounded-md w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm m-1">Open Task</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
