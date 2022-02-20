@extends('courses.manage.taskMaster')

@section('task')
<subtasks :tasks="{{ json_encode($tasks) }}" :task="{{ $task }}"></subtasks>
@endsection
