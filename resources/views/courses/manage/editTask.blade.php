@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @include('courses.partials.taskOverview')
            <x-card name="task" header="{{ $task->name }}" class="xl:col-span-2">
                <x-slot name="headerCorner">
                    <a href="{{ route('courses.manage.index', $course) }}"
                       class="bg-lime-green-500 flex text-sm items-center px-1 py-0.5 rounded-md hover:bg-lime-green-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </x-slot>
                <form method="post" action="{{ route('courses.manage.updateTask', [$course->id, $task->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label for="name"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $task->name) }}" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="project-id"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">GitLab
                                Project
                                Id</label>
                            <input readonly value="{{ $task->source_project_id }}" type="text" id="project-id" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                            <span class="text-xs dark:text-gray-400">Remember to add the ScalableTeaching System User to
                                the project as a maintainer</span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="description"
                               class="text-sm font-medium text-gray-900  dark:text-gray-300 block mb-2">Description</label>
                        <textarea id="description" rows="4" name="description"
                                  class="bg-gray-50 border border-gray-300 dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">{{ old('description', $task->short_description) }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Start and end
                            date</label>
                        <date-range from="{{ old('from', $task->starts_at->toDateString()) }}"
                                    to="{{ old('to', $task->ends_at->toDateString()) }}"></date-range>
                    </div>
                    <div class="mb-2 grid grid-cols-2 gap-4">
                        <div>
                            <label for="start-time"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Start
                                time</label>
                            <input name="start-time" value="{{ old('start-time', $task->starts_at->format('H:i')) }}"
                                   id="start-time" type="text" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="end-time"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">End
                                time</label>
                            <input name="end-time" value="{{ old('end-time', $task->ends_at->format('H:i')) }}"
                                   type="text" id="end-time" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                    </div>
                    <p class="mb-6 dark:text-gray-400">The <code>readme.md</code> file will automatically be used as the
                        instruction text for the assignment. The assignment will be invisible to the students until you
                        change the visibility.</p>
                    <div class="flex justify-between items-end">
                        <div>
                            <button type="submit"
                                    class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg px-3 py-2 text-center transition-colors">
                                Save Changes
                            </button>
                        </div>
                        <div class="flex">
                            <a href="{{ route('courses.manage.toggleVisibility', [$course->id, $task->id]) }}"
                               class="text-white bg-gray-400 mr-2 hover:bg-gray-500 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg px-3 py-2 text-center transition-colors flex">
                                @if($task->is_visible)
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </span>
                                    <span>Make Invisible</span>
                                @else
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </span>
                                    <span>Make Visible</span>
                                @endif
                            </a>
                            <a href="{{ route('courses.manage.refreshReadme', [$course->id, $task->id]) }}"
                               class="text-white bg-gray-400 flex hover:bg-gray-500 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg px-3 py-2 text-center transition-colors">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </span>
                                <span>Refresh readme.md</span>
                            </a>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
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
            definitions: {
                // <any single char>: <same type as mask (RegExp, Function, etc.)>
                // defaults are '0', 'a', '*'

            }
        };
        window.IMask(document.getElementById('start-time'), config)
        window.IMask(document.getElementById('end-time'), config)
    </script>
@endsection
