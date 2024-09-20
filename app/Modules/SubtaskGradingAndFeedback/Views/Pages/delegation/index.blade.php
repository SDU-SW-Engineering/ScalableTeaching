@php
    $delegationRouteBase = "courses.tasks.admin.subtaskGradingAndFeedback.delegation.";
    $delegationFolderBase = "module-SubtaskGradingAndFeedback::Pages.delegation.";
    $isGradeDisabled = $task->isAutomaticallyGraded();
@endphp

@extends('tasks.admin.master')

@section('adminContent')

    @include($delegationFolderBase . "partials.tabs")
    <section class="grid gap-4 grid-cols-2">
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md p-4 rounded-md">
            <div class="flex items-center gap-4">
                @if(request()->has('type'))
                    @include($delegationFolderBase . "partials.index.backIcon")
                @endif
                <h3 class="text-xl dark:text-white font-semibold">Delegate</h3>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Delegate projects amongst a specific course role or
                specific course member and
                specify the amount of
                projects each recipient should give feedback on. Projects will automatically be delegated upon task
                end.</p>
            <hr class="my-2">
            @if($errors->any())
                <span class="text-sm text-red-600 pb-2">{{ $errors->first() }}</span>
            @endif
            @if(request()->has('type'))
                <form class="flex flex-col gap-4 w-full" method="post"
                      action="{{ route($delegationRouteBase . "store", [$course, $task, 'pool' => request('type')]) }}">
                    @csrf
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            @if(request('type') == 'role')
                                @include($delegationFolderBase . "partials.index.roleSelection")
                            @else
                                @include($delegationFolderBase . "partials.index.userSelection")
                            @endif
                        </div>
                        <div class="w-1/2">
                            <span class="text-sm font-bold dark:text-white">Feedback on</span>
                            <select name="type"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                                <option value="last_pushes">Last pushes before deadline</option>
                                <option value="succeeding_pushes">Succeeding pushes (excluding failed projects)
                                </option>
                                <option value="succeed_last_pushes">Succeeding pushes + last pushes for failed
                                    projects
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold dark:text-white">Deadline</span>
                        <div class="flex">
                            <input name="deadline_date"
                                   value="{{ old('deadline_date', $task->ends_at->addWeeks(2)->format('Y-m-d')) }}"
                                   class="w-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"
                                   type="date">
                            <input id="deadline" name="deadline_hour" value="{{ old('deadline_hour', '23:59') }}"
                                   class="w-1/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"
                                   type="text">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-left text-sm font-bold dark:text-white">Options</span>
                        <div>
                            <input @checked(old('options.grade')) name="options[grade]" id="grade" type="checkbox"
                                @class([
                                    "w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer",
                                    "cursor-not-allowed" => $isGradeDisabled
                                ])
                                @disabled($isGradeDisabled)>
                            <label for="grade"
                                @class([
                                     "text-gray-900 dark:text-gray-300 ml-2 font-medium text-sm",
                                     "dark:text-gray-600 italic font-normal cursor-not-allowed" => $isGradeDisabled
                                 ])
                            >Grade</label>
                        </div>
                        <div>
                            <input @checked(old('options.feedback')) id="feedback" type="checkbox"
                                   name="options[feedback]"
                                   class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                            <label for="feedback" class="ml-2 font-medium text-gray-900 text-sm dark:text-gray-300">Feedback</label>
                        </div>
                        <div>
                            <input @checked(old('options.moderation')) name="options[moderation]" id="moderation"
                                   type="checkbox"
                                   class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                            <label for="moderation"
                                @class(['text-gray-900 dark:text-gray-300 ml-2 font-medium text-sm'])
                            >Feedback moderation</label>
                        </div>
                    </div>
                    <div>
                        <label for="tasks" class="text-left text-sm font-bold dark:text-white">Number of
                            Projects</label>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Specify how many projects each user
                            should give feedback on.</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 italic">Inputting 0 means each user has
                            to review ALL projects.</p>
                        <input value="1" name="tasks"
                               min="0"
                               max="{{ $task->projects->count() }}"
                               id="tasks"
                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"
                               type="number">
                    </div>
                    <div class="flex flex-col justify-center">
                        <button type="submit"
                                class="text-white bg-lime-green-700 hover:bg-lime-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center dark:bg-lime-green-600 dark:hover:bg-lime-green-700 dark:focus:ring-lime-green-800">
                            Add
                        </button>
                    </div>
                </form>
            @else
                <div class="flex w-full gap-2 mt-1.5">
                    <a href="{{ route($delegationRouteBase . "index", [$course, $task, 'type' => 'role']) }}"
                       class="w-1/2 active-btn">Role
                        based</a>
                    <a href="{{ route($delegationRouteBase . "index", [$course, $task, 'type' => 'user']) }}"
                       class="w-1/2 active-btn">User
                        based</a>
                </div>
            @endif

        </div>
        @include($delegationFolderBase . "partials.index.taskDelegationList")
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" defer>
        let config = {
            mask: 'hh:mm',
            lazy: false,
            blocks: {
                hh: {
                    mask: IMask.MaskedRange,
                    from: 0,
                    to: 23
                },
                mm: {
                    mask: IMask.MaskedRange,
                    from: 0,
                    to: 59
                }
            },
        };
        window.IMask(document.getElementById('deadline'), config)
    </script>
@endsection
