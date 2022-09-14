@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-thin mb-4 dark:text-white">Groups</h1>
            <group-settings save-route="{{ route('courses.manage.groups.update-settings', $course) }}" :group-size-input="{{ $course->max_group_size }}" :max-group-custom="{{ $course->max_groups_amount }}" max-groups-input="{{ $course->max_groups }}"/>
        </div>
        <form class="flex mb-4">
            <input type="text" id="filter" name="filter" value="{{ request('filter') }}" class="disabled:bg-gray-200 dark:disabled:bg-gray-700 bg-gray-50
                           border border-gray-300 text-gray-900 sm:text-sm rounded-l-md focus:outline-none p-2.5 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">

            <button type="submit"
                    class="bg-lime-green-400 hover:bg-lime-green-500 transition-colors items-center text-white flex p-2 rounded-r-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                    <path fill-rule="evenodd"
                          d="M3.792 2.938A49.069 49.069 0 0112 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 011.541 1.836v1.044a3 3 0 01-.879 2.121l-6.182 6.182a1.5 1.5 0 00-.439 1.061v2.927a3 3 0 01-1.658 2.684l-1.757.878A.75.75 0 019.75 21v-5.818a1.5 1.5 0 00-.44-1.06L3.13 7.938a3 3 0 01-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836z"
                          clip-rule="evenodd"/>
                </svg>
                <span>Filter</span>
            </button>
        </form>
        <div class="grid gap-4 xl:grid-cols-3">
            @foreach($groups as $group)
                <a href="{{ route('courses.manage.groups.show', [$course, $group]) }}"
                   class="cursor-pointer hover:bg-lime-green-500 hover:border-transparent hover:shadow-lg group block rounded-lg p-4 border border-gray-200 dark:border-gray-500">
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
                                    <img alt="avatar" class="w-7 h-7 rounded-full border-2 border-white"
                                         src="{{ $member->avatar }}"/>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </a>
            @endforeach
        </div>
        <div class="mt-4">
            {!! $groups->links() !!}
        </div>
    </div>
@endsection
