@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <enrolled :users="{{ $members }}" role-route="{{ $roleRoute }}" kick-route="{{ $kickRoute }}" activity-route="{{ $activityRoute }}" :roles="{{ json_encode($roles) }}"></enrolled>
    </div>
@endsection
