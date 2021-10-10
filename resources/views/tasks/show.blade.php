@extends('master')

@section('content')
    @include('partials.subnavbar', ['title' => $task->name])
    <task description="{{ $task->description }}"></task>
@endsection
