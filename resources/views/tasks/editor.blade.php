@extends('master')

@section('content')
    <editor context="{{ $context }}" :delegation="{{ $delegation }}" :sub-tasks="{{ $subtasks }}"></editor>
@endsection
