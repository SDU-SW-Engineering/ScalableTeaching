@extends('tasks.admin.master')

@section('adminContent')
    @include('tasks.admin.partials.delegationTabs')
    @if($taskDelegation->delegated)
        <div class="grid grid-cols-2 gap-2">
            @foreach($users as $user)
                <div class="bg-white dark:bg-gray-800 shadow-md rounded p-4 flex justify-between">
                    <div class="flex flex-col justify-between">
                        <div class="flex justify-start">
                            <img class="h-8 w-8 rounded-full border-4 border-lime-green-300 mr-4"
                                 src="{{ $user->avatar }}">
                            <div>
                                <h3 class="font-medium dark:text-white leading-4">{{ $user->name }}</h3>
                                <span class="text-sm text-lime-green-500">Student</span>
                            </div>
                        </div>
                        <span class="font-medium text-xs text-lime-green-600 mt-4">1/2 Reviewed</span>
                    </div>
                    <div class="flex flex-col gap-4">
                        @foreach($groupedByUser[$user->id] as $projectDelegation)
                            <div class="bg-white dark:bg-gray-700 border p-1.5 dark:border-none hover:shadow rounded w-72">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm dark:text-gray-300 leading-none">{{ $projectDelegation->project->ownable->name }}</span>
                                    <div class="flex gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" @class(['h-6 w-6', rand(0,1) == 1 ? 'text-lime-green-300' : 'text-gray-400']) fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" @class(['h-6 w-6', rand(0,1) == 1 ? 'text-blue-300' : 'text-gray-400']) fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" @class(['h-6 w-6', rand(0,1) == 1 ? 'text-yellow-200' : 'text-gray-400']) fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center mt-8">
            <h2 class="text-xl font-medium text-gray-500">This task is currently not delegated</h2>
            <h3 class="text-lg font-thin text-gray-600">It will be delegated automatically shortly
                after {{ $task->ends_at }} <span class="text-lime-green-700">({{ $task->ends_at->diffForHumans() }}
                    )</span></h3>
        </div>
    @endif
@endsection
