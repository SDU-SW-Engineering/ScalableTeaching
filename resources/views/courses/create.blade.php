@extends('master')

@section('content')
    <div class="px-6 pt-4 lg:max-w-xl container mx-auto">
        <form action="{{ route('courses.store') }}" method="post">
            @csrf
            <label>Name of course</label>
            <input type="text" name="course-name">
            <button type="submit">Create</button>
        </form>
    </div>
@endsection
