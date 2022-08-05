@extends('tasks.admin.master')

@section('adminContent')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button
                    @class(['inline-block p-4 border-b-2 rounded-t-lg', 'text-lime-green-500 border-lime-green-500']) id="profile-tab"
                    data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    Overview
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Delegated
                </button>
            </li>
        </ul>
    </div>
    <section class="grid gap-4 grid-cols-2">
        <div class="flex flex-col bg-white shadow-md p-4 rounded-md">
            <h3 class="text-xl font-semibold">Delegate amongst roles</h3>
            <p class="text-sm text-gray-600">Delegate tasks amongst a specific course role and specify the amount of
                tasks each recipient should give feedback on.</p>
            <hr class="my-2">
            <table class="table-fixed">
                <thead>
                <tr>
                    <th class="w-1/2 text-left text-sm">Role</th>
                    <th class="w-1/4 text-left text-sm"># of Tasks</th>
                    <th class="w-1/4 text-left text-sm">Action</th>
                </tr>
                </thead>
                <tbody>
                <form>
                    <tr>
                        <td>
                            <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                                @foreach($course->roles as $role)
                                    <option>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input value="1"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"
                                   type="number">
                        </td>
                        <td>
                            <button type="submit"
                                    class="text-white bg-lime-green-700 hover:bg-lime-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center dark:bg-lime-green-600 dark:hover:bg-blue-700 dark:focus:ring-lime-green-800">
                                Add
                            </button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
        <div class="flex flex-col">
            <div class="shadow-md p-4 rounded-md bg-white">
                <h3 class="text-xl font-semibold">Gradual delegation</h3>
                <p class="text-sm text-gray-600">Delegate tasks amongst a specific course role and specify the amount of
                    tasks each recipient should give feedback on.</p>
                <hr class="my-2">
                <div class="flex items-center mr-4">
                    <input id="inline-checkbox" type="checkbox" value=""
                           class="w-5 h-5 text-lime-green-600 bg-gray-100 rounded border-gray-300 focus:ring-lime-green-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-checkbox" class="ml-2 font-medium text-gray-900 dark:text-gray-300">Enable</label>
                </div>
                <button type="submit"                         class="text-white bg-lime-green-700 hover:bg-lime-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center dark:bg-lime-green-600 dark:hover:bg-blue-700 dark:focus:ring-lime-green-800">
                    Save
                </button>
            </div>
        </div>
    </section>
@endsection
