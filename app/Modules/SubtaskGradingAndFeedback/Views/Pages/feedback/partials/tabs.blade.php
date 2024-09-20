<div class="flex justify-between items-center">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <a href="{{ route($feedbackRouteBase . "index", [$course, $task]) }}"
                   @class(['inline-block p-4 border-b-2 rounded-t-lg', request()->route()->getName() == $feedbackRouteBase . "index" && request('reviewed') == null ? 'text-lime-green-500 border-lime-green-500': 'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:text-gray-200']) id="profile-tab"
                   data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Queue ({{ $commentPendingCount }})
                </a>
            </li>
            <li class="mr-2" role="presentation">
                <a href="{{ route($feedbackRouteBase . "index", [$course, $task, "reviewed" => "true"]) }}"
                   @class(['inline-block p-4 border-b-2 rounded-t-lg', request("reviewed") != null ? 'text-lime-green-500 border-lime-green-500': 'border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:text-gray-200']) id="profile-tab"
                   data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Reviewed ({{ $commentHistoryCount }})
                </a>
            </li>
        </ul>
    </div>
    <div>
        <span class="dark:text-white sm:text-sm">Filter:</span>
        <!-- TODO: Review if this really is the only way to set query parameters from js onchange event. - Currently it breaks looking at reviewed comments with a filter.-->
        <select onchange="window.location = location.pathname + (this.value === 'null' ? '' : '?filter=' + this.value)" name="project" class="py-0 text-sm text-black dark:bg-gray-800 dark:text-white border-none rounded-sm mr-2">
            <option value="null">None</option>
            @foreach($projectNames as $projectId => $projectName)
                <option @selected($projectId == request('filter')) value="{{ $projectId }}">{{ $projectName }}</option>
            @endforeach
        </select>
    </div>
</div>
