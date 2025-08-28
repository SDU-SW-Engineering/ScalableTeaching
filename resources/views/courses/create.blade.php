@extends('master')

@section('content')
    <div class="px-6 pt-6 container mx-auto">
        <form action="{{ route('courses.store') }}" method="post">
            @csrf
            <div
                class="py-4 px-6 lg:max-w-xl container mx-auto flex flex-col bg-white border dark:border-gray-700 shadow dark:bg-gray-800 rounded-md">
                <h2 class="text-xl font-medium mb-2 text-lime-green-700 dark:text-lime-green-400">Create course</h2>
                <label for="course" class="text-sm text-lime-green-700 dark:text-gray-300">
                    Name
                </label>
                <input value="{{ old('course-name') }}" id="course" type="text" name="course-name" placeholder="Advanced programming"
                       class=" bg-gray-50 flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-lime-green-400  block w-full p-2.5 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200"/>

                <div class="flex mt-3">
                    <input type="checkbox" value="{{old('access-to-gitlab-group')}}" name="access-to-gitlab-group" class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-lime-green-700 dark:focus:ring-lime-green-800 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" />
                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Give teachers admin access to course on Gitlab?</span>
                </div>

                @if($errors->any())
                    <div class="text-red-800 dark:text-red-500 text-sm font-semibold">
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
