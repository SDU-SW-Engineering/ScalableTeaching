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
                <x-slot name="toolbar">
                    <a href="{{ route('courses.manage.subtasks', [$course, $task]) }}" class="text-gray-300 hover:bg-gray-500 px-1 py-0.5 rounded-sm mr-2">Tasks</a>
                </x-slot>
                @yield('task')
            </x-card>

        </div>
    </div>
@endsection
