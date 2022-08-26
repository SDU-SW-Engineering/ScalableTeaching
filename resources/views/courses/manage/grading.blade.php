@extends('courses.manage.master')

@section('manageContent')
    <div class="grid grid-cols-1">
        <grading :grades="{{ $grades }}" :tasks="{{ $course->tasks()->assignments()->pluck('name', 'id') }}"
                 :course-id="{{ $course->id }}"></grading>
    </div>
@endsection
