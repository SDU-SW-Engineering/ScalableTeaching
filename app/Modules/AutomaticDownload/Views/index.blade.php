@php use App\Models\Enums\DownloadState; @endphp
@extends('tasks.admin.master')

@section('adminContent')
    <div>
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Downloads</h1>
        @if ($missing->count() || $enabledAfterDeadline)
            <div class="mb-4 inline-block">
                <div class="bg-red-200 shadow text-red-900 rounded-lg p-4 flex text-sm gap-4 w-1/2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="w-10 h-10 text-red-500">
                            <path fill-rule="evenodd"
                                  d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                  clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        @if ($enabledAfterDeadline)
                            <p class="mb-4">These projects have never been queued for download (due to this module being
                                enabled after the deadline). Do you wish to download all of them now? Downloading will
                                take approximately <span
                                    class="font-black">{{ round(($downloads->count() * 20) / 60) }}</span> minutes if no
                                other projects are currently queued.
                            </p>
                            <div class="inline-block">
                                <a href="{{ route('courses.tasks.admin.automaticDownload.create-all', [$course, $task]) }}"
                                   class="p-1.5 shrink hover:bg-red-600 text-white rounded-sm bg-red-500 flex gap-1 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Download all</a>
                            </div>
                        @else
                            <p class="mb-4"><span class="font-black">{{ $missing->count() }}</span> projects that have
                                previously been downloaded are missing from your disk. Do you wish to queue all of them?
                                Downloading will take approximately <span
                                    class="font-black">{{ round(($missing->count() * 20) / 60) }}</span> minutes if no
                                other projects are currently queued.</p>
                            <div class="inline-block">
                                <a href="{{ route('courses.tasks.admin.automaticDownload.queue-all', [$course, $task]) }}"
                                   class="p-1.5 shrink hover:bg-red-600 text-white rounded-sm bg-red-500 flex gap-1 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Queue all</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-600 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span>Student / Group</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Download status</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span>Notes</span>
                </th>
                <th scope="col" class="px-6 py-3 flex justify-end">
                    <span>Actions</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($downloads as $index => $download)
                <tr
                    class=" border-b {{ $index % 2 == 0 ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }} dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $download['ownableName'] }}</td>
                    @if ($task->has_ended)
                        @if ($download['download'])
                            @if ($download['download']->state == DownloadState::OnDisk)
                                <td class="flex items-center px-6 py-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-lime-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </td>
                                <td class="px-6">
                                    <span>Expires {{ $download['download']->expire_at->diffForHumans() }}.</span>
                                </td>
                                <td class="flex px-6 py-4 gap-2 justify-end align-items-center">

                                    <a target="_self" href="{{ route('courses.tasks.show-editor', [$course, $task, $download['project']]) }}"
                                       class="py-2 px-4 active-btn">Open</a>

                                    <a href="{{ route('courses.tasks.admin.automaticDownload.download', [$course, $task, $download['download']]) }}"
                                       class="py-2 px-4 active-btn flex gap-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        Download</a>

                                </td>
                            @else
                                @if ($download['download']->queued_at != null && $download['download']->queued_at->addMinutes(1)->isFuture())
                                    <td class="flex items-center px-6 py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </td>
                                    <td class="px-6">
                                        Queued for download.
                                    </td>
                                    <td></td>
                                @else
                                    <td class="flex items-center px-6 py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4">
                                        Reported as downloaded but was not found on the system.
                                    </td>
                                    <td class="flex px-6 py-4 justify-end">
                                        <a href="{{ route('courses.tasks.admin.automaticDownload.queue', [$course, $task, $download['download']]) }}"
                                           class="p-1.5 hover:bg-lime-green-500 text-white rounded-sm bg-lime-green-400 flex gap-1 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Queue
                                        </a>
                                    </td>
                                @endif
                            @endif
                        @else
                            <td class="flex items-center px-6 py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                @if ($download['project']->relevantPushes()->count() == 0)
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
                        <td></td>
                        <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
