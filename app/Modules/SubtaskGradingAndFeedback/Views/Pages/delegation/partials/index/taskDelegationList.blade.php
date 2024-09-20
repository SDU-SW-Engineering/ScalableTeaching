<div class="flex flex-col gap-4">
    @foreach($task->delegations as $delegation)
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md p-4 rounded-md">
            <h3 class="text-xl dark:text-white font-semibold">{{ $delegation->courseRoleName() }}
                Delegation</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">This task is currently <span
                    class="font-bold text-lime-green-600">{{ $delegation->delegated ? 'delegated' : 'not delegated' }}</span>.
            </p>
            @unless($task->delegated)
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Shortly after the deadline {{ $task->ends_at }} ({{ $task->ends_at->diffForHumans() }}), the
                    task will be delegated
                    amongst {{ $delegation->userPoolCount() }} {{ Str::plural(strtolower($delegation->courseRoleName())) }}.
                    At that point this task delegation can no longer be deleted.
                </p>
            @endunless
            <form method="post"
                  action="{{ route($delegationRouteBase . "delete", [$course, $task, $delegation]) }}"
                  class="flex justify-between mt-4">
                @method('DELETE')
                @csrf
                <a href="{{ route($delegationRouteBase . "show", [$course, $task, $delegation]) }}" class="active-btn w-1/4">View</a>
                <button type="submit"
                        @class([
	                        "w-1/4 destructive-btn",
	                        "disabled-btn" => $delegation->delegated
                        ])
                        @disabled($delegation->delegated)
                >
                    Delete
                </button>
            </form>
        </div>
    @endforeach
</div>
