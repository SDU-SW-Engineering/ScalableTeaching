@php
    $delegationFolderBase = "module-SubtaskGradingAndFeedback::Pages.delegation.";
@endphp

@extends('tasks.admin.master')

@section('adminContent')
    @include($delegationFolderBase . "partials.tabs")
    @if($taskDelegation->delegated)
        <div class="grid grid-cols-2 gap-2">
            @foreach($users as $user)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded p-4 flex justify-between">
                    <div class="flex flex-col justify-between">
                        <div class="flex justify-start">
                            <img class="h-8 w-8 rounded-full border-4 border-lime-green-300 mr-4"
                                 src="{{ $user->avatar }}">
                            <div>
                                <h3 class="font-medium dark:text-white leading-4">{{ $user->name }}</h3>
                                <span class="text-sm text-lime-green-500">{{ $taskDelegation->course_role_id == 1 ? "Student" : "Teacher" }}</span>
                            </div>
                        </div>
                        <span
                            class="font-medium text-xs text-lime-green-600 mt-4">{{ $groupedByUser[$user->id]->filter(fn($x) => $x->reviewed)->count() }}
                            /{{ $groupedByUser[$user->id]->count() }} Reviewed</span>
                    </div>
                    <div class="flex flex-col gap-4">
                        @foreach($groupedByUser[$user->id] as $projectDelegation)
                            <div
                                class="bg-white dark:bg-gray-700 border p-1.5 dark:border-none rounded w-72 project-{{ $projectDelegation->project_id }}">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm dark:text-gray-300 leading-none">{{ $projectDelegation->project->ownable->name }}</span>
                                    <div class="flex gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             @class(['h-6 w-6', $projectDelegation->reviewed ? 'text-lime-green-300' : 'text-gray-400']) fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             @class(['h-6 w-6', $downloadDictionary->has($projectDelegation->project_id) ? 'text-blue-300' : 'text-gray-400']) fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             @class(['h-6 w-6',  $indexDictionary->has($projectDelegation->sha) ? 'text-yellow-200' : 'text-gray-400']) fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @include($delegationFolderBase . "partials.show.notDelegated")
    @endif

@endsection

@section('scripts')
    <script type="text/javascript">
        // The code below is used to change the color of the project boxes when hovered over
        // This ensures the same project is highlighted across all users that are giving feedback.
        let classes = [{!! $task->projects->pluck('id')->map(fn($id) => '\'project-' . $id . '\'')->join(', ') !!}]; //list of your classes
        let elms = {};
        let n = {}, nclasses = classes.length;
        let hoverClasses = ['bg-lime-green-100', 'dark:bg-lime-green-800'];
        let nonHoverClasses = ['bg-white', 'dark:bg-gray-700'];

        function changeColor(classname, remove, add) {
            let curN = n[classname];
            for (let i = 0; i < curN; i++) {
                elms[classname][i].classList.remove(...remove);
                elms[classname][i].classList.add(...add);
            }
        }

        for (let k = 0; k < nclasses; k++) {
            const curClass = classes[k];
            elms[curClass] = document.getElementsByClassName(curClass);
            n[curClass] = elms[curClass].length;
            const curN = n[curClass];
            for (let i = 0; i < curN; i++) {
                elms[curClass][i].onmouseover = function () {
                    changeColor([...this.classList].filter(x => classes.includes(x)), nonHoverClasses, hoverClasses);
                };
                elms[curClass][i].onmouseout = function () {
                    changeColor([...this.classList].filter(x => classes.includes(x)), hoverClasses, nonHoverClasses);
                };
            }
        }
    </script>
@endsection
