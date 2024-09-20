@extends('tasks.admin.master')

@section('adminContent')
    <div class="dark:bg-gray-800 p-4 dark:text-white rounded-lg">
        <h1 class="font-light text-2xl mb-2">Subtasks</h1>
        <subtask-list :task="{{ $task }}" :sub-tasks="{{ $subTasks }}"></subtask-list>
    </div>
@endsection
