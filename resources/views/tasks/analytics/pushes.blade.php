@extends('tasks.analytics.master')

@section('adminContent')
    <div class="dark:bg-gray-800 p-4 rounded-lg">
        <h1 class="font-light dark:text-white text-2xl">Pushes</h1>
        <h1 class="font-medium dark:text-gray-400 text-xl -mt-2 mb-4">{{ $pushes->count() }} pushes</h1>
        @foreach($pushes as $push)
            <div class="bg-gray-700 flex mb-4 rounded-md items-center py-3 px-2">
                <div class="px-4 flex items-center flex-col flex-shrink-0 w-40">
                    {!! $push->project->ownable->avatarHtml !!}
                    <span class="text-gray-200 text-xs mt-1">{{ $push->project->ownable->shortName }}</span>
                </div>
                <div class="flex items-center flex-1">
                    <div class="w-3/6">
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-white">{{ $push->before_sha }}</span>
                            <span class="text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                             stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        </svg></span>
                            <span class="text-xs text-white font-medium">{{ $push->after_sha }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-center w-3/6">
                        <div class="flex gap-2">
                            @if($push->created_at->lte($task->ends_at, true))
                                <div
                                    class="flex bg-lime-green-400 text-lime-green-800 rounded-sm px-1 items-center mb-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm">Accepted</span>
                                </div>
                            @else
                                <div
                                    class="flex bg-red-400 text-red-800 rounded-sm px-1 items-center mb-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="text-sm">Rejected</span>
                                </div>
                            @endif
                            @if($push->download() != null)
                                <div
                                    class="flex bg-blue-400 text-blue-800 rounded-sm px-1 items-center mb-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span class="text-sm">Downloaded</span>
                                </div>
                            @endif
                        </div>
                        <span
                            class="text-white text-sm">{{ $push->created_at->diffForHumans($task->ends_at) }} deadline</span>
                        <span class="text-gray-400 text-xs">{{ $push->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-sm flex items-center bg-gray-500 hover:bg-gray-400 transition-colors text-gray-100 py-1 px-1 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span class="text-sm my-1">Open External</span>
                    </a>
                </div>
            </div>
        @endforeach
        {!! $pushes->links() !!}
    </div>
@endsection
