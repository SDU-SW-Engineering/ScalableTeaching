@php use App\Models\Group;use App\Models\User;use App\ProjectStatus; @endphp

<table class="min-w-full">
    <thead class="bg-gray-50 dark:bg-gray-800">
    <tr>
        <th scope="col"
            class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
            Users
        </th>
        <th scope="col"
            class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
            <a class="flex items-center"
               href="{{ request()->fullUrlWithQuery(['sort' => 'pipelines_count', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                @if (request('sort') == 'pipelines_count')
                    @if (request('direction') == 'asc')
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
                        </svg>
                    @endif
                @endif
                <span>Builds</span>
            </a>
        </th>
        @if($task->sub_tasks != null)
            <th scope="col"
                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                <span>Progress</span>
            </th>
        @endif
        <th scope="col"
            class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
            Status
        </th>
        @if(request('status') == 'finished')
            <th class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                Finished
            </th>
            <th scope="col"
                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                <a class="flex items-center justify-end"
                   href="{{ request()->fullUrlWithQuery(['sort' => 'duration', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                    @if (request('sort') == 'duration')
                        @if (request('direction') == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                 viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
                            </svg>
                        @endif
                    @endif
                    <span>Duration</span>
                </a>
            </th>
        @endif
        <th class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
            Created at
        </th>
        <th scope="col"
            class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
            Actions
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr class="bg-white dark:bg-gray-600 border-b dark:border-gray-800">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                @if($project->ownable_type == User::class)
                    {{ $project->ownable->name }}
                @elseif($project->ownable_type == Group::class)
                    {{ $project->ownable->name }} <span
                        class="text-gray-400">({{ $project->ownable->memberString }})</span>
                @else
                    {{ $project->repo_name }}
                @endif
            </td>
            <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                {{ $project->pipelines->count() }}
            </td>
            <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                {{ $project->progress() }}%
            </td>
            <td class="text-sm flex text-gray-500 px-6 py-4 whitespace-nowrap">
                @if($project->status == ProjectStatus::Active)
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6 active text-yellow-400 mr-2" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @else
                    @if($project->status == ProjectStatus::Finished)
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 text-lime-green-300 handed-in mr-2"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    @else
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="h-6 w-6 text-red-300 failed-hand-in mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    @endif
                @endif

                @if($task->isValidationEnabled())
                    @if($project->validationStatus == 'pending')
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 waiting-for-verification" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @elseif($project->validationStatus == 'success')
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-lime-green-400 validated-success"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-red-500 validated-failed" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                @endif
            </td>
            @if(request('status') == 'finished')
                <td class="text-sm text-gray-500 dark:text-gray-300 px-6 py-4 whitespace-nowrap">
                    {{ $project->finished_at->diffForHumans() }}
                </td>
                <td class="text-sm text-gray-500 dark:text-gray-200 px-6 py-4 whitespace-nowrap text-right">
                    {{ $project->duration }} days
                </td>
            @endif
            <td class="text-sm text-gray-500 dark:text-gray-300 px-6 py-4 whitespace-nowrap">
                {{ $project->created_at->diffForHumans() }}
            </td>
            <td class="w-px">
                <div class="flex mr-3">
                    <a type="button"
                       href="{{ route('courses.tasks.showProject', [$course->id, $task->id, $project->id]) }}"
                       class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-l-lg text-xs px-3 py-2 text-center">Open</a>
                    <a type="button"
                       @if($project->status == ProjectStatus::Finished)
                           href="{{ route('courses.tasks.downloadProject', [$course->id, $task->id, $project->id]) }}"
                        @endif
                        @class([
                             'text-white font-medium text-xs px-3 py-2 text-center',
                             'not-done cursor-not-allowed bg-gray-500' => $project->status != ProjectStatus::Finished,
                             'bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300' => $project->status == ProjectStatus::Finished,
                             'rounded-r-lg' => !$task->isValidationEnabled(),
                         ])
                    >Download</a>
                    @if($task->isValidationEnabled())
                        <a type="button"
                           @if($project->status == ProjectStatus::Finished)
                               href="{{ route('courses.tasks.validateProject', [$course->id, $task->id, $project->id]) }}"
                            @endif
                            @class([
                                 'text-white font-medium text-xs px-3 py-2 text-center',
                                 'cant-validate cursor-not-allowed bg-gray-500' => $project->status != ProjectStatus::Finished,
                                 'bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300' => $project->status == ProjectStatus::Finished,
                                 'rounded-r-lg' => !$task->isValidationEnabled(),
                             ])
                        >Validate</a>
                    @endif
                </div>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
