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
        <div class="flex flex-col col-span-2 bg-white shadow-md p-4 rounded-md">
            <h3 class="text-xl font-semibold">Delegate amongst roles</h3>
            <p class="text-sm text-gray-600">Delegate tasks amongst a specific course role and specify the amount of
                tasks each recipient should give feedback on. Tasks will be automatically delegated upon deadline
                end.</p>
            <hr class="my-2">
            @if($errors->any())
                <span class="text-sm text-red-600 pb-2">{{ $errors->first() }}</span>
            @endif
            <div class="flex flex-col">
                <div class="flex w-full gap-4">

                </div>
                <form class="flex gap-8 w-full" method="post"
                      action="{{ route('courses.tasks.admin.addDelegation', [$course, $task]) }}">
                    @csrf
                    <div class="w-3/12">
                        <span class="text-sm font-bold">Role</span>
                        <select name="role"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                            @foreach($eligibleRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="w-4/12">
                        <span class="text-sm font-bold">Feedback on</span>
                        <select name="role"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500">
                            <option value="student">Last pushes before deadline</option>
                            <option value="teacher">Succeeding pushes (excluding failed projects)</option>
                            <option>Succeeding pushes + last pushes for failed projects</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-left text-sm font-bold">Options</span>
                        <div>
                            <input id="grade" type="checkbox" value="" class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="grade" class="ml-2 font-medium text-gray-900 text-sm dark:text-gray-300">Grade</label>
                        </div>
                        <div>
                            <input id="feedback" type="checkbox" value="" class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="feedback" class="ml-2 font-medium text-gray-900 text-sm dark:text-gray-300">Feedback</label>
                        </div>
                    </div>
                    <div >
                        <span class="text-left text-sm font-bold"># of Tasks</span>
                        <input value="1" name="tasks"
                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-green-500 focus:border-lime-green-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-green-500 dark:focus:border-lime-green-500"
                               type="number">
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-sm font-bold">Action</span>
                        <button type="submit"
                                class="text-white bg-lime-green-700 hover:bg-lime-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center dark:bg-lime-green-600 dark:hover:bg-blue-700 dark:focus:ring-lime-green-800">
                            Add
                        </button>
                    </div>
                </form>
            </div>
            @foreach($task->delegations as $currentlyDelegated)
                <form action="{{ route('courses.tasks.admin.removeDelegation', [$course, $task]) }}"
                      method="post">
                    <table class="table-fixed">
                        <tbody>
                        <tr class="text-sm border-t">
                            <td class="w-1/2 text-left text-sm py-1">{{ $currentlyDelegated->role->name }}</td>
                            <td class="w-1/4">{{ $currentlyDelegated->number_of_tasks }}</td>
                            <td>
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="role" value="{{ $currentlyDelegated->id }}">
                                <button type="submit" class="text-red-800">Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            @endforeach
        </div>
        {{-- <div class="flex flex-col">
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
        </div> --}}
    </section>
@endsection
