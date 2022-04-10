@extends('tasks.analytics.master')

@section('analyticsContent')
    <div class="flex justify-between">
        <div></div>
        <div class="flex items-center mb-4">
            <div class="h-2.5 rounded-full bg-red-400 w-6"></div>
            <span class="text-xs dark:text-white ml-2 mr-4">Passed < 33% </span>
            <div class="h-2.5 rounded-full bg-gray-400 w-6"></div>
            <span class="text-xs dark:text-white ml-2 mr-4">33% >= Passed < 66%  </span>
            <div class="h-2.5 rounded-full bg-lime-green-400 w-6"></div>
            <span class="text-xs dark:text-white ml-2">Passed >= 66%</span>
        </div>
    </div>
    @foreach($subtasks as $subtaskGroup)
        <div class="dark:bg-gray-800 px-4 py-3 mb-4 rounded-lg shadow-sm">
            <div class="flex items-end justify-between">
                <h1 class=" dark:text-white text-2xl">{{ $subtaskGroup['group'] }}</h1>
                <h2 class="dark:text-lime-green-300 text-xl">{{ $subtaskGroup['maxPoints'] }} pts</h2>
            </div>
            <div>
                <ul class="ml-4">
                    @foreach($subtaskGroup['tasks'] as $task)
                        <li class="dark:text-gray-200 font-light my-2">
                            <div class="flex justify-between items-center">
                                <span class="mr-6">{{ $task['name'] }}</span>
                                <div class="flex justify-center flex-shrink-0">
                                    <span
                                        class="flex-shrink-0 mr-2 font-bold">{{ $task['percentage'] }}%</span>
                                    <div class="w-48 bg-gray-200 mt-2 rounded-full h-2.5 dark:bg-gray-700 mr-2">
                                        <div @class(['h-2.5 rounded-full', match(true) {
                                            $task['percentage'] >= 66 => 'bg-lime-green-400',
                                            $task['percentage'] >= 33 => 'bg-gray-400',
                                            default => 'bg-red-400'
                                        } ]) style="width: {{ $task['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-light text-lime-green-100">{{ $task['maxPoints'] }} pts</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endsection
