@extends('master')

@section('content')

    <div class="px-6 pt-6 container mx-auto">
        <form action="{{ route('courses.store') }}" method="post">
            @csrf
            <div
                class="py-4 px-6 lg:max-w-xl container mx-auto flex flex-col bg-white border shadow dark:bg-gray-700 rounded-md">
                <h2 class="text-xl font-medium mb-2 text-lime-green-700">Create course</h2>
                <label for="course" class="text-sm text-lime-green-700 dark:text-gray-400">
                    Name
                </label>
                <input id="course" type="text" name="course-name" placeholder="Advanced programming"
                       class=" bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-400  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"/>
                @if($errors->any())
                    <div class="text-red-800 text-sm font-semibold">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button
                    class="flex-shrink-0 mt-3 bg-white hover:bg-lime-green-500 text-lime-green-700 font-semi-bold hover:text-white py-2 px-4 border border-lime-green-500 hover:border-transparent rounded-lg"
                    type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
