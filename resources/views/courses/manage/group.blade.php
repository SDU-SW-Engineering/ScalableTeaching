@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <h1 class="text-3xl font-thin mb-4 dark:text-white">{{ $group->name }}</h1>
        <div class="flex mb-4 justify-between items-center">
            <form method="post" action="{{ route('courses.manage.groups.add-member', [$course, $group]) }}" class="flex flex-col">
                @csrf
                <div class="flex">
                    <input type="text" id="email" name="email" value="" placeholder="Email" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           border border-gray-300 text-gray-900 sm:text-sm rounded-l-md focus:outline-none p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
                    <button type="submit"
                            class="bg-lime-green-400 hover:bg-lime-green-500 transition-colors items-center text-white flex p-2 rounded-r-md">
                        <span>Add</span>
                    </button>
                </div>
                @if($errors->any())
                    <span class="text-sm dark:text-red-500">{{ $errors->first() }}</span>
                @endif
            </form>
            <form method="post" action="{{ route('courses.manage.groups.delete', [$course, $group]) }}">
                @method('DELETE')
                @csrf
                <button name="btnCanDelete" type="submit"
                        class="mr-2 group flex items-center hover:bg-red-200 hover:text-red-800 transition-colors rounded-md bg-red-100 text-red-700 px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 mr-2 h-4 w-5 h-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4">
            @foreach($members as $member)
                <form method="post" action="{{ route('courses.manage.groups.remove-member', [$course, $group, 'user' => $member->id]) }}"
                    class="flex justify-between flex-col hover:bg-lime-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                    @csrf
                    @method('DELETE')
                    <div class="flex">
                        <img alt="avatar" class="w-16 h-16 border-2 rounded-lg group-hover:border-lime-green-600"
                             src="{{ $member->avatar }}"/>
                        <div class="ml-4 ">
                            <h2 class="dark:text-white font-medium">{{ $member->name }}</h2>
                            <a style="word-break: break-word" class="inline-block text-sm dark:group-hover:text-gray-700 dark:text-lime-green-400 break-words" href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                        </div>
                    </div>
                    <button type="submit" class="bg-red-500 w-full text-center mt-4 rounded-md text-sm dark:text-white dark:hover:bg-red-700">Remove</button>
                </form>
            @endforeach
        </div>
    </div>
@endsection
