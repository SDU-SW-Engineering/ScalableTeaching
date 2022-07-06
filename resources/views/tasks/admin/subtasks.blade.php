@extends('tasks.admin.master')

@section('analyticsContent')
    <div class="dark:bg-gray-800 p-4 rounded-lg">
        <h1 class="font-light dark:text-white text-2xl mb-2">Sub-tasks</h1>
        <subtask-list :task="{{ $task }}" :sub-tasks="{{ $subTasks }}"></subtask-list>
    </div>
@endsection
