@extends('master')

@section('content')
    @include('partials.subnavbar', ['title' => $task->name, 'previousRoute' => route('courses.show', $task->course_id)])
    <task description="{{ $task->description }}"></task>
@endsection
