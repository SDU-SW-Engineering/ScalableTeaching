@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @include('courses.partials.taskOverview')
            <x-card name="new" header="New Task" class="xl:col-span-2">
                <form method="post" action="{{ route('courses.tasks.store', $course) }}">
                    @csrf
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label for="name"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="project-id"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">GitLab
                                Project
                                Id</label>
                            <input name="project-id" value="{{ old('project-id') }}" type="text" id="project-id" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                            <span class="text-xs dark:text-gray-400">Remember to add the ScalableTeaching System User to
                                the project as a maintainer</span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="text-sm font-medium text-gray-900  dark:text-gray-300 block mb-2">Description</label>
                        <textarea id="description" rows="4" name="description"
                                  class="bg-gray-50 border border-gray-300 dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Start and end
                            date</label>
                        <date-range from="{{ old('from') }}" to="{{ old('to') }}"></date-range>
                    </div>
                    <div class="mb-2 grid grid-cols-2 gap-4">
                        <div>
                            <label for="start-time"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">Start
                                time</label>
                            <input name="start-time" value="{{ old('start-time') }}" id="start-time" type="text" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="end-time"
                                   class="text-sm font-medium text-gray-900 block dark:text-gray-300 mb-2">End
                                time</label>
                            <input name="end-time" value="{{ old('end-time') }}" type="text" id="end-time" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                        </div>
                    </div>
                    <p class="mb-6 dark:text-gray-400">The <code>readme.md</code> file will automatically be used as the
                        instruction text for the assignment. The assignment will be invisible to the students until you
                        change the visibility.</p>
                    <button type="submit"
                            class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:ring-lime-green-300 font-medium rounded-lg px-3 py-2 text-center transition-colors">
                        Create
                    </button>
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
