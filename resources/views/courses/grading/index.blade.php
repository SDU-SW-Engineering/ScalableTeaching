@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1">
            <x-card name="students" header="Students">
                <grading :grades="{{ $grades }}" :tasks="{{ $course->tasks->pluck('name', 'id') }}"></grading>
            </x-card>
        </div>
    </div>
@endsection
