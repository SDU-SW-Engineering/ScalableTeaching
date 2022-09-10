@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg grid grid-cols-1">
        <grading :grades="{{ $grades }}" :tasks="{{ $course->tasks()->assignments()->pluck('name', 'id') }}"
                 :course-id="{{ $course->id }}"></grading>
    </div>
@endsection
