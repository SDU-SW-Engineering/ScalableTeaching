@extends('master')

@section('content')
    <editor context="{{ $context }}" :delegation="{{ $delegation }}"></editor>
@endsection
