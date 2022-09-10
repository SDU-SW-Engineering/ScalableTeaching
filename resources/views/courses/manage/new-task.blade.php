@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <new-task-wizard :course="{{ $course }}"/>
    </div>
@endsection
