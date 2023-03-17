@extends('tasks.admin.master')

@section('adminContent')
    <div class="container mx-auto">
        <div class="bg-white shadow-lg p-4 rounded-t-md h-80 dark:bg-gray-900 border dark:border-gray-800">
            <div class="flex justify-between items-center">
                <h3 class="text-gray-800 dark:text-gray-100 text-xl font-semibold mb-3">Builds Per Day</h3>
                @if(request()->has('q'))
                    <div class="flex items-center">
                        <a class="bg-lime-green-500 text-white text-sm px-2 py-0.5 hover:bg-lime-green-600 transition-colors rounded-md mr-2"
                           href="{{ request()->url() }}">Clear filter</a>
                    </div>
                @endif
            </div>
            <div>
                <bar-chart :disable-animations="true" :height="250" :labels="{{ $dailyBuildsGraph->labels() }}"
                           :data="{{ $dailyBuildsGraph->datasets()  }}"
                           route="{{ route('courses.tasks.admin.builds', [$course->id, $task->id]) }}"></bar-chart>
            </div>
        </div>
        <div class="overflow-x-auto shadow-md rounded-b-md bg-gray-600">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden">
                    <div
                        class="bg-gray-50 dark:bg-gray-800 min-w-full py-2 pl-6 pr-3 flex justify-between items-center">
                        <h2 class="text-lg  dark:text-gray-200">Builds</h2>
                        <div class="flex items-center">
                            <!--<form>
                                <input type="text" autocomplete="off"
                                       class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-800 text-gray-900 dark:text-gray-100 text-xs rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 mr-2"
                                       placeholder="Filter" required>
                            </form>-->
                            <a href="{{ request()->fullUrlWithQuery(['status'=>'success']) }}"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'success',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'success'
                                    ])
                            >Succeeded</a>
                            <a href="{{ request()->fullUrlWithQuery(['status'=>'failed']) }}"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'failed',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'failed'
                                    ])
                            >
                                Failed
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status'=>'canceled']) }}"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'canceled',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'canceled'
                                    ])
                            >
                                Canceled
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status'=> null]) }}"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md' => request()->get('status','all') == 'all',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status', 'all') != 'all'
                                    ])
                            >
                                All
                            </a>
                        </div>
                    </div>
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                Author
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                Owner
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                Run Time
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                When
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($builds as $build)
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                                    <div class="flex items-center">
                                        <div @class(['flex-shrink-0 rounded-full h-8 w-8 flex items-center justify-center', 'bg-lime-green-200' => $build->status == \App\Models\Enums\PipelineStatusEnum::Success, 'bg-red-200' => $build->status == \App\Models\Enums\PipelineStatusEnum::Failed, 'bg-yellow-200' => $build->status == \App\Models\Enums\PipelineStatusEnum::Pending, 'bg-blue-200' => $build->status == \App\Models\Enums\PipelineStatusEnum::Running, 'bg-gray-200' => $build->status == \App\Models\Enums\PipelineStatusEnum::Canceled])>
                                            @if($build->status == \App\Models\Enums\PipelineStatusEnum::Success)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 text-lime-green-700"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            @elseif($build->status == \App\Models\Enums\PipelineStatusEnum::Failed)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-700"
                                                     fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            @elseif($build->status == \App\Models\Enums\PipelineStatusEnum::Running)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @elseif($build->status == \App\Models\Enums\PipelineStatusEnum::Pending)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-700"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            @elseif($build->status == \App\Models\Enums\PipelineStatusEnum::Canceled)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-700">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                                <span class="capitalize">{{ $build->status->value }}</span>
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $build->runner }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                                    <div class="text-sm text-gray-900 dark:text-gray-200">{{ $build->user_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $build->user_email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 flex flex-col">
                                    @if($build->project == null)
                                        <i>Not connected</i>
                                    @elseif($build->project->ownable_type == \App\Models\User::class)
                                        {{ $build->project->ownable->name }}
                                    @elseif($build->project->ownable_type == \App\Models\Group::class)
                                        <span>{{ $build->project->ownable->name }}</span>
                                        <span class="text-gray-400">({{ $build->project->ownable->memberString }}
                                            )</span>
                                    @else
                                        {{ $build->project->repo_name }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span>{{ $build->run_time }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 overflow">
                                        Queued for {{ $build->queued_for}}
                                    </div>
                                </td>
                                <td class="text-sm text-gray-500 px-6 py-4 whitespace-nowrap dark:text-gray-200">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-200">
                                        <span>{{ $build->updated_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $build->updated_at->toDateTimeString() }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($builds->hasPages())
                        <div class="py-2 px-3">
                            {{ $builds->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
