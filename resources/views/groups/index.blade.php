@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        @include('courses.partials.tabs')
        <groups csrf="{{ csrf_token() }}" :create-groups="{{ json_encode($canCreateGroup) }}" :initial-groups="{{ $groups->toJson() }}"
                create-url="{{ route('courses.groups.create', $course->id) }}" :initial-invitations="{{ $invitations }}"></groups>
    </div>
@endsection
