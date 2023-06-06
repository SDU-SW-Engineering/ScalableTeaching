@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <exercises create-task-route="{{ route('courses.manage.storeTask', [$course]) }}" reorganize-route="{{ $reorganizeRoute }}" :initial-groups="{{ $groups }}"></exercises>
    </div>
@endsection
