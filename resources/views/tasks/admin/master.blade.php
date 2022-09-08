@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="flex mb-4 justify-between items-center">
            <h1 class="text-4xl dark:text-white font-thin">{{ $task->name }}</h1>
            <div>
                <div class="flex items-center">
                    <div class="mr-20 flex gap-20">
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">{{ $task->projects->count() }}</span>
                            <span class="font-thin text-lg dark:text-gray-300">projects</span>
                        </div>
                        <div class="flex items-center justify-center flex-col">
                            <span class="text-lime-green-600 -mb-2 text-3xl dark:text-lime-green-300 font-bold">0</span>
                            <span class="font-thin text-lg dark:text-gray-300">builds</span>
                        </div>
                    </div>
                    <visibility-dropdown route="{{ route('courses.tasks.admin.toggle-visibility', [$course, $task]) }}" :is-visible="{{ $task->is_visible ? 'true' : 'false' }}" :is-publishable="{{ $task->is_publishable ? 'true' : 'false' }}"></visibility-dropdown>
                </div>
            </div>
        </div>
        <div class="flex">
            @include('tasks.admin.partials.sidebar')
            <div class="flex-grow-1 w-full">
                @yield('adminContent')
            </div>
        </div>
    </div>
@endsection
