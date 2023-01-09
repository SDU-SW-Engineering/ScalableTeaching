@extends('tasks.admin.master')

@section('adminContent')
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-md shadow-md">
                    <div
                        class="bg-gray-100 dark:bg-gray-800 min-w-full py-2 pl-6 pr-3 flex justify-between items-center">
                        <h2 class="text-lg  dark:text-gray-200">Students</h2>
                        <div class="flex items-center">
                            <!--<form>
                                <input type="text" autocomplete="off"
                                       class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-800 text-gray-900 dark:text-gray-100 text-xs rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 mr-2"
                                       placeholder="Filter" required>
                            </form>-->
                            <a href="{{ request()->url() }}?status=finished"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'finished',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'finished'
                                    ])
                            >Completed</a>
                            <a href="{{ request()->url() }}?status=active"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md mr-2' => request()->get('status') == 'active',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status') != 'active'
                                    ])
                            >
                                Active
                            </a>
                            <a href="{{ request()->url() }}"
                                @class([
                                        'text-white text-sm bg-lime-green-400 px-2 py-0.5 rounded-md' => request()->get('status','all') == 'all',
                                        'text-gray-600 dark:text-white text-sm px-2 py-0.5 hover:bg-lime-green-200 dark:hover:bg-lime-green-800 rounded-md mr-2' => request()->get('status', 'all') != 'all'
                                    ])
                            >
                                All
                            </a>
                        </div>
                    </div>
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                Users
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                viewed
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                viewed date
                            </th>
                            <th scope="col"
                                class="text-xs font-medium text-gray-700 dark:text-gray-200 px-6 py-3 text-left uppercase tracking-wider">
                                completed
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr class="bg-white dark:bg-gray-600 border-b dark:border-gray-800">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                    {{ $student->name }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
