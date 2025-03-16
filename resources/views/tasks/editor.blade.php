@extends('master')

@section('content')
    <editor context="{{ $context }}" :delegation="{{ $delegation ?? 'null' }}" :sub-tasks="{{ $subtasks ?? 'null' }}" download-link="{{$downloadLink}}"></editor>
@endsection
