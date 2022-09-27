@extends('tasks.admin.master')

@section('adminContent')
    @include('tasks.admin.partials.delegationTabs')
    @if($taskDelegation->delegated)

    @else
        <div class="flex flex-col items-center mt-8">
            <h2 class="text-xl font-medium text-gray-500">This task is currently not delegated</h2>
            <h3 class="text-lg font-thin text-gray-600">It will be delegated automatically shortly
                after {{ $task->ends_at }} <span class="text-lime-green-700">({{ $task->ends_at->diffForHumans() }}
                    )</span></h3>
        </div>
    @endif
@endsection
