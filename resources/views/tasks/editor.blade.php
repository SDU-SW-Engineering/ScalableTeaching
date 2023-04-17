@extends('master')

@section('content')
    <editor context="{{ $context }}" :delegation="{{ $delegation ?? 'null' }}" :sub-tasks="{{ $subtasks ?? 'null' }}"></editor>
@endsection
