@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        @include('courses.partials.tabs')
        <groups csrf="{{ csrf_token() }}" :initial-groups="{{ $groups }}" create-url="{{ route('courses.groups.create', $course->id) }}"></groups>
    </div>
@endsection
