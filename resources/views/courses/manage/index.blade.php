@extends('master')

@section('content')
    <div class="px-6 pt-4 container mx-auto">
        @include('courses.partials.tabs')
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <div class="shadow-lg">
                <header class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white rounded-t-lg text-lg px-6 py-4">
                    Teachers
                </header>
                <div class="bg-white dark:bg-gray-600 rounded-b-lg p-6 ">
                    @if($errors->hasBag('teachers'))
                        <div class="bg-red-200 px-3 py-4 flex rounded mb-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-3"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <div class="text-red-900">
                                <div class="font-medium">There were {{ $errors->teachers->count() }} errors with your
                                    form
                                </div>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->teachers->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @foreach($course->teachers->sortBy('name') as $teacher)
                        <div
                            class="bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 px-3 py-1 flex justify-between items-center rounded-lg mb-2 last:mb-0">
                            <div class="flex flex-col">
                                <span class="text-gray-700 dark:text-gray-300">{{ $teacher->name }}</span>
                                <span class="text-sm text-gray-400">{{ $teacher->email }}</span>
                            </div>
                            @unless($teacher->id == auth()->id())
                                <a href="{{ route('courses.manage.removeTeacher', [$course->id, $teacher->id]) }}"
                                   class="hover:text-gray-400 dark:text-gray-100 dark:hover:text-gray-300 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endunless
                        </div>
                    @endforeach
                    <h3 class="dark:text-white mb-1">Add teacher</h3>
                    <form method="post" action="{{ route('courses.manage.addTeacher', [$course->id]) }}">
                        @csrf
                        <user-select name="teacher"></user-select>
                        <button type="submit"
                                class="bg-lime-green-500 px-2 py-1 rounded-md mt-3 w-full text-gray-100 hover:bg-lime-green-600 transition-colors">
                            Add
                        </button>
                    </form>
                </div>
            </div>
            <x-card name="enroll" header="Enrollment">
                <x-slot name="content">
                    <p class="text-black dark:text-white mb-2 text-sm">You can share the link below to let student join the course.</p>
                    <input type="text" id="groupname" readonly
                           value="{{ route('courses.enroll', [$course->id, 'token' => $course->enroll_token]) }}"
                           class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           flex-grow border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200"
                    >
                </x-slot>
            </x-card>
        </div>
    </div>
@endsection
