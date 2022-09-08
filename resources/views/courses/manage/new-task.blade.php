@extends('courses.manage.master')

@section('manageContent')
<new-task-wizard :course="{{ $course }}"/>
@endsection
