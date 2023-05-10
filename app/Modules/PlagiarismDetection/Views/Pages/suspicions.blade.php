@php use App\Models\Project; @endphp
@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <h1 class="flex items-center text-xl">Suspicions</h1>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Student
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Comparisons
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($suspicions as $group => $suspicion)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ Project::find($group)->owner_names }}
                        </th>
                        <td class="px-6 py-4">
                            <ul>
                                @foreach($suspicion as $entry)
                                    <li class="mb-2"><a class="underline text-lime-green-500"
                                                        href="{{ route('courses.tasks.admin.plagiarismDetection.compare', [$course, $task, $group , 'with' => [$entry->project_2_id]]) }}"
                                                        target="_blank">{{ Project::find($entry->project_2_id)->owner_names }}</a>
                                        - <a href="{{ route('courses.tasks.admin.plagiarismDetection.removeSuspicions', [$course, $task, $group , 'to' => $entry->project_2_id]) }}" class="font-bold text-red-600 ">Remove</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
@endsection
