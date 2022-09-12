@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <h1 class="text-3xl font-thin mb-4 dark:text-white">Groups</h1>
        <div class="grid xl:grid-cols-3">
            @foreach($groups as $group)
                <a href="{{ route('courses.manage.groups.show', [$course, $group]) }}" class="cursor-pointer hover:bg-lime-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                    <dl class="grid sm:block lg:grid xl:block grid-cols-2 grid-rows-2 items-center">
                        <div>
                            <dt class="sr-only">Title</dt>
                            <dd class="group-hover:text-white leading-6 font-medium text-black dark:text-white">
                                {{ $group->name }}
                            </dd>
                        </div>
                        <div>
                            <dt class="sr-only">Category</dt>
                            <dd class="group-hover:text-lime-green-200 text-sm font-medium sm:mb-4 lg:mb-0 xl:mb-4 text-gray-500 dark:text-gray-400">
                                {{ $group->members_count }} members, {{ $group->projects_count }} projects
                            </dd>
                        </div>
                        <div class="col-start-2 row-start-1 row-end-3">
                            <dt class="sr-only">Users</dt>
                            <dd class="flex justify-end sm:justify-start lg:justify-end xl:justify-start -space-x-2">
                                @foreach($group->members as $member)
                                    <img class="w-7 h-7 rounded-full border-2 border-white" src="{{ $member->avatar }}"/>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </a>
            @endforeach
        </div>
    </div>
@endsection
