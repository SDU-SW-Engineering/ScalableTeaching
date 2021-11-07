<x-card name="enroll" header="Tasks">
    <x-slot name="headerCorner">
        <a href="{{ route('courses.manage.createTask', $course) }}"
           class="bg-lime-green-500 flex text-sm items-center pl-1 pr-2 py-0.5 rounded-md hover:bg-lime-green-600 transition-colors">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </span>
            <span>New</span>
        </a>
    </x-slot>
    @foreach($course->tasks as $task)
        <a href="{{ route('courses.manage.editTask', [$course->id, $task->id]) }}"
           class="cursor-pointer hover:bg-gray-700 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500
           @if(request()->is("*manage/tasks/$task->id/edit")) dark:bg-gray-800 dark:border-gray-600 @else border-gray-200 @endif">
            <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                <div class="flex justify-between items-center mb-2">
                    <dd class="group-hover:text-white leading-6 font-medium text-black dark:text-white">
                        {{ $task->name }}
                    </dd>
                    <div class="flex items-center text-lime-green-500">
                        @if ($task->ends_at->isPast())
                            <span>Ended</span>
                        @elseif (now()->between($task->starts_at, $task->ends_at))
                            <span>Active</span>
                        @else
                            <span>Not Begun</span>
                        @endif
                        @if($task->is_visible)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        @endif
                    </div>
                </div>
                <div>
                    <div
                        class="flex gap-2 text-lime-green-600 dark:text-lime-green-400 text-sm justify-between mb-2">
                        <div class="flex flex-col"><span
                                class="font-bold">{{ $task->starts_at->toDateString() }}</span> <span
                                class="text-xs text-gray-400">{{ $task->starts_at->toTimeString() }}</span>
                        </div>

                        <div class="flex items-end flex-col"><span
                                class="font-bold">{{ $task->ends_at->toDateString() }}</span> <span
                                class="text-xs text-gray-400">{{ $task->ends_at->toTimeString() }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-xs flex dark:text-gray-300 mb-1 justify-between items-center">
                    <span
                        class="font-black">{{ $task->participants()->where('project_status', "finished")->count() }}</span>
                    <span class="text-xs">Progress</span>
                    <span class="font-black">{{ $task->participants()->count() }}</span>
                </div>
                <div>
                    <dt class="sr-only">Category</dt>
                    <dd class="group-hover:text-lime-green-200 text-sm font-medium text-gray-500 dark:text-gray-400">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-lime-green-400 h-2.5 rounded-full"
                                 style="width: {{ $task->participants()->count() == 0 ? 0 : $task->participants()->where('project_status', "finished")->count() / $task->participants()->count() * 100 }}%"></div>
                        </div>
                    </dd>
                </div>
            </dl>
        </a>
    @endforeach
</x-card>
