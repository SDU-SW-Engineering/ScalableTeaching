@extends('tasks.admin.master')

@section('adminContent')
    @include("module-Subtasks::Partials.navbar")
    @foreach($subtaskGroups as $subtaskGroup)
        <div class="dark:bg-gray-800 bg-gray-100 border px-4 py-3 mb-4 rounded-lg shadow-sm">
            <div class="flex items-end justify-between">
                <h1 class=" dark:text-white text-2xl">{{ $subtaskGroup['group'] }}</h1>
                <h2 class="dark:text-lime-green-300 text-xl"><span class="font-thin text-gray-400">{{ $subtaskGroup['average'] }} /</span> {{ $subtaskGroup['maxPoints'] }}
                    pts</h2>
            </div>
            <div>
                <ul class="ml-4">
                    @foreach($subtaskGroup['tasks'] as $task)
                        <li class="dark:text-gray-200 font-light my-2">
                            <div class="flex justify-between items-center">
                                <span class="mr-6">{{ $task['name'] }}</span>
                                <div class="flex justify-center items-center flex-shrink-0">
                                    <span
                                            class="flex-shrink-0 mr-2 text-light">0</span>
                                    <div class="w-48 bg-gray-200 rounded-full h-4 dark:bg-gray-700 mr-2 text-center">
                                        <div @class(['h-4 rounded-full text-gray-900 text-xs', match(true) {
                                            $task['percentage'] >= 66 => 'bg-lime-green-400',
                                            $task['percentage'] >= 33 => 'bg-gray-400',
                                            default => 'bg-red-400'
                                        } ]) style="width: {{ min($task['percentage'], 100) }}%">
                                            @if($task['percentage'] > 0)
                                                <span class="text-black font-bold">{{ round($task['average'], 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-light text-lime-green-700 dark:text-lime-green-100 w-12">{{ $task['maxPoints'] }} pts</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endsection
