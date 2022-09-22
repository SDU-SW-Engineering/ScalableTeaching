@extends('tasks.admin.master')

@section('adminContent')
    <div class="grid grid-cols-4 gap-4">
        <form method="post" action="{{ route('courses.tasks.admin.update-title', [$course, $task]) }}"
              class="flex flex-col w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
            @csrf
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-black dark:text-white text-2xl font-thin">Title</h1>
                <button type="submit" class="hover:bg-gray-200 p-1 rounded text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                         height="24" style="transform: ;msFilter:;">
                        <path
                            d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path>
                    </svg>
                </button>
            </div>
            <div>
                <input type="text" name="title" value="{{ old('title', $task->name) }}"
                       class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"
                />
            </div>
            @error('title', 'title')
            <span class="text-sm text-red-600">{{ $errors->title->first() }}</span>
            @enderror
            @if(session()->has('title-success'))
                <span class="text-sm text-lime-green-500 dark:text-lime-green-300">Changes saved.</span>
            @endif
        </form>
        <form method="post" action="{{ route('courses.tasks.admin.update-duration', [$course, $task]) }}"
              class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg col-span-3">
            @csrf
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-black dark:text-white text-2xl font-thin">Duration</h1>
                <button type="submit" class="hover:bg-gray-200 p-1 rounded text-gray-400 hover:text-gray-500">
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                         height="24" style="transform: ;msFilter:;">
                        <path
                            d="M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zM7 5h4v2h2V5h2v4H7V5zm0 8h10v6H7v-6z"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 dark:bg-gray-500 dark:border-none rounded border p-3">
                    <h3>From</h3>
                    <div class="grid grid-cols-5 gap-2 mt-2">
                        <input type="date" value="{{ old('to', $task->starts_at?->format('Y-m-d')) }}" name="from"
                               class="disabled:bg-gray-200 col-span-4 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                        />
                        <input id="start-time" type="text" name="start-time"
                               value="{{ old('start-time', $task->starts_at?->format('H:i')) }}"
                               class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                        />
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-500 dark:border-none rounded border p-3">
                    <h3>To</h3>
                    <div class="grid grid-cols-5 gap-2  mt-2">
                        <input type="date" value="{{ old('to', $task->ends_at?->format('Y-m-d')) }}" name="to"
                               class="disabled:bg-gray-200 col-span-4 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                        />
                        <input id="end-time" type="text" name="end-time"
                               value="{{ old('end-time', $task->ends_at?->format('H:i')) }}"
                               class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-white flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-600 dark:border-gray-700 dark:text-gray-200"
                        />
                    </div>
                </div>
            </div>
            @if($errors->duration->any())
                <span class="text-sm text-red-600">{{ $errors->duration->first() }}</span><br>
            @endif
            @if(session()->has('duration-success'))
                <span class="text-sm text-lime-green-500 dark:text-lime-green-300">Changes saved.</span><br>
            @endif
        </form>
        <div class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg col-span-4">
            <h1 class="text-black dark:text-white text-2xl font-thin mb-2 -mt-2">Description</h1>
            <markdown-editor :task="{{ $task }}"></markdown-editor>
        </div>
        @isset($subTasks)
            <div class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg col-span-3">
                <subtasks :tasks="{{ json_encode($subTasks) }}" :task="{{ $task }}"></subtasks>
            </div>
        @endisset
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
        };
        window.IMask(document.getElementById('start-time'), config)
        window.IMask(document.getElementById('end-time'), config)
    </script>
@endsection

