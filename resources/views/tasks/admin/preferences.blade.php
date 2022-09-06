@extends('tasks.admin.master')

@section('adminContent')
        <div class="flex-grow-1 w-full bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
            <h1 class="text-white text-2xl font-thin mb-2 -mt-2">Description</h1>
            <markdown-editor></markdown-editor>
        </div>

@endsection
