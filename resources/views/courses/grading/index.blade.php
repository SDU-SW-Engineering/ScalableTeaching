@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-card name="students" header="Students">
                <grading/>
            </x-card>
            <x-card name="groups" header="Groups">
            </x-card>
        </div>
    </div>
@endsection
