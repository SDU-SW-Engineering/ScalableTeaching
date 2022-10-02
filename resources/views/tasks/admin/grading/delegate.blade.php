@extends('tasks.admin.master')

@section('adminContent')
    @include('tasks.admin.partials.delegationTabs')
    <section class="grid gap-4 grid-cols-2">
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md p-4 rounded-md">
            <h3 class="text-xl dark:text-white font-semibold">Delegate amongst roles</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Delegate tasks amongst a specific course role and
                specify the amount of
                tasks each recipient should give feedback on. Tasks will be automatically delegated upon deadline
                end.</p>
            <hr class="my-2">
            @if($errors->any())
                <span class="text-sm text-red-600 pb-2">{{ $errors->first() }}</span>
            @endif
            <div class="flex">
                <form class="flex flex-col gap-4 w-full" method="post"
                      action="{{ route('courses.tasks.admin.addDelegation', [$course, $task]) }}">
                    @csrf
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <span class="text-sm font-bold dark:text-white">Role</span>
                            <select name="role"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                                @foreach($eligibleRoles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <span class="text-sm font-bold dark:text-white">Feedback on</span>
                            <select name="type"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                                <option value="last_pushes">Last pushes before deadline</option>
                                <option value="succeeding_pushes">Succeeding pushes (excluding failed projects)</option>
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
                                   @disabled($task->correction_type != \App\Models\Enums\CorrectionType::Manual)
                                   class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="grade"
                                @class([$task->correction_type == \App\Models\Enums\CorrectionType::Manual ? 'text-gray-900 dark:text-gray-300' : 'text-gray-400', 'ml-2 font-medium text-sm'])
                            >Grade (Only available in manual correction mode)</label>
                        </div>
                        <div>
                            <input @checked(old('options.feedback')) id="feedback" type="checkbox"
                                   name="options[feedback]"
                                   class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="feedback" class="ml-2 font-medium text-gray-900 text-sm dark:text-gray-300">Feedback</label>
                        </div>
                        <div>
                            <input @checked(old('options.moderation')) name="options[moderation]" id="moderation"
                                   type="checkbox"
                                   class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="moderation"
                                @class(['text-gray-900 dark:text-gray-300 ml-2 font-medium text-sm'])
                            >Feedback moderation</label>
                        </div>
                    </div>
                    <div>
                        <span class="text-left text-sm font-bold dark:text-white">Number of Tasks</span>
                        <input value="1" name="tasks"
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
            </div>
        </div>
        <div>
            @foreach($task->delegations as $delegated)
                <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md p-4 rounded-md">
                    <h3 class="text-xl dark:text-white font-semibold">{{ $delegated->course_role_id == 1 ? 'Student' : 'Teacher' }}
                        Delegation</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">This task is currently <span
                            class="font-bold text-lime-green-600">{{ $delegated->delegated ? 'delegated' : 'not delegated' }}</span>.
                    </p>
                    @unless($task->delegated)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            Shortly after the deadline {{ $task->ends_at }} ({{ $task->ends_at->diffForHumans() }}), the
                            task will be delegated
                            amongst {{ $course->students()->count() }} {{ Str::plural('student') }}.
                            At that point this task delegation can no longer be deleted.
                        </p>
                    @endunless
                    <form method="post"
                          action="{{ route('courses.tasks.admin.removeDelegation', [$course, $task, $delegated]) }}"
                          class="flex flex-col justify-center mt-4">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center dark:bg-lime-green-600 dark:hover:bg-lime-green-700 dark:focus:ring-lime-green-800">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
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
