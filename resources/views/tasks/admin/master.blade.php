@extends('master')

@section('content')
    <div class="container mx-auto px-6 pt-4">
        <div class="flex">
            @include('tasks.admin.partials.sidebar')
            <div class="flex-grow-1 w-full">
                @yield('adminContent')
            </div>
        </div>
    </div>
@endsection

