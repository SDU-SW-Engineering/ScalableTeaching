@extends('courses.manage.master')

@section('manageContent')
    <div class="bg-white dark:bg-gray-600 shadow p-4 rounded-lg">
        <p class="text-center text-gray-400 text-sm">Logs are kept for two years from date of origin.</p>
        <form method="get" action="{{ route('courses.manage.activity.index', $course) }}" class="flex items-end gap-6 mt-4">
            <div class="w-2/5">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                <input type="text" id="search" name="user"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ request('user', '') }}"      />
            </div>
            <div class="w-2/5">
                <label for="kind" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Kind</label>
                <select id="kind" name="kind"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Any</option>
                    <option @selected(request('kind') == 'grade') value="grade">Grade</option>
                    <option @selected(request('kind') == 'membership') value="membership">Membership</option>
                    <option @selected(request('kind') == 'group') value="group">Group</option>
                    <option @selected(request('kind') == 'group-invitation') value="group-invitation">Group Invitation</option>
                    <option @selected(request('kind') == 'group-membership') value="group-membership">Group Membership</option>
                </select>
            </div>
            <div class="w-1/5">
                <button type="submit" class="text-white bg-lime-green-500 hover:bg-lime-green-600 focus:ring-4 focus:outline-none focus:ring-lime-green-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-lime-green-500 dark:hover:bg-lime-green-600 dark:focus:ring-lime-green-800">Filter</button>
            </div>
        </form>
        <div class="overflow-x-auto relative mt-4 border border-gray-200 dark:border-none rounded">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Affected
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Message
                    </th>
                    <th scope="col" class="py-3 px-6">
                        By
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Kind
                    </th>
                    <th scope="col" class="py-3 px-6">
                        When
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($activities as $activity)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $activity->affected->name }}</th>
                        <td class="py-4 px-6">
                            {!! $activity->message !!}
                        </td>
                        <td class="py-4 px-6">
                            {{ $activity->affectedBy?->name ?? 'System' }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $activity->kind }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $activity->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {!! $activities->links() !!}
        </div>
    </div>
@endsection
