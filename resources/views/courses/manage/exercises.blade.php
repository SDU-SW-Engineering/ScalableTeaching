@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <exercises reorganize-route="{{ $reorganizeRoute }}" :initial-groups="{{ $groups }}"></exercises>
    </div>
@endsection
