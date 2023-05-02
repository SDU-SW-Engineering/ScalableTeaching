@extends('tasks.admin.master')

@section('adminContent')
    <div class="">
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Visualizations</h1>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-600 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Student / Group
                </th>
                <th scope="col" class="px-6 py-3">
                    Downloaded
                </th>
                <th scope="col" class="px-6 py-3">
                    Notes
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($downloads as $index => $download)
                <tr class=" border-b {{ $index % 2 == 0 ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }} dark:border-gray-700">
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $download['project']->ownable->name }} @if($download['project']->ownable_type == \App\Models\Group::class)
                            <span class="text-gray-500">({{ $download['project']->owners()->pluck('name')->join(', ') }}
                                )</span>
                        @endif</th>
                    @if($task->has_ended)
                        @if($download['download'])
                            @if($download['download']->state == \App\Models\Enums\DownloadState::OnDisk)
                                <td class="flex items-center px-6 py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-6 h-6 text-lime-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </td>
                                <td class="px-6">
                                    Expire {{ $download['download']->expire_at->diffForHumans() }}.
                                </td>
                                <td class="flex items-center px-6 py-4">
                                    <a type="button"
                                       href="{{ route('courses.tasks.admin.visualizations.showVisualization', [$course->id, $task->id, $download['download']]) }}"
                                       target="_blank"
                                       class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg text-xs px-3 py-2 text-center">Show</a>
                                </td>
                            @else
                                @if($download['download']->queued_at != null && $download['download']->queued_at->addMinutes(10)->isFuture())
                                    <td class="flex items-center px-6 py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6">
                                        Project needs to be downloaded first
                                    </td>
                                    <td></td>
                                @else
                                    <td class="flex items-center px-6 py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor" class="w-6 h-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4">
                                        Project needs to be downloaded first
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <a type="button"
                                           class="text-white bg-gray-400 hover:bg-gray-300 cursor-not-allowed focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg text-xs px-3 py-2 text-center">Show</a>
                                    </td>
                                @endif
                            @endif
                        @else
                            <td class="flex items-center px-6 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                @if($download['project']->relevantPushes()->count() == 0)
                                    No push within deadline.
                                @else
                                    Was never queued for download.
                                @endif
                            </td>
                            <td class="">

                            </td>
                        @endif
                    @else
                        <td class="flex items-center px-6 py-4">
                            <span class="italic">Waiting for task to end...</span>
                        </td>
                        <td class="flex items-center px-6 py-4">

                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
