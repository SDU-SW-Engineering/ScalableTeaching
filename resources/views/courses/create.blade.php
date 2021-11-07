@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @include('courses.partials.taskOverview')
            <x-card name="new" header="New Task" class="xl:col-span-2">
                <date-range></date-range>
            </x-card>
        </div>

    </div>
@endsection

