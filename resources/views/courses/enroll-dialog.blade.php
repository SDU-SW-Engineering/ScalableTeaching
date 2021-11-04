@extends('master')

@section('content')
    <div class="px-6 pt-4 lg:max-w-xl container mx-auto">
        <x-confirm header="Course Enrollment" sub-header="{{ $course->name }}"
                   accept-route="{{ route('courses.enroll', [$course->id, 'token' => request('token'), 'confirm']) }}"
                   decline-route="{{ route('home') }}">
            <p class="text-gray-800 dark:text-gray-200">You are about to be enrolled in the course
                <b>{{ $course->name }}</b>, press accept to continue.</p>
        </x-confirm>
    </div>
@endsection
