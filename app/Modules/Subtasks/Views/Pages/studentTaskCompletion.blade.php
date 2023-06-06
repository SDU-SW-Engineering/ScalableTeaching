@extends('tasks.admin.master')

@section('adminContent')
    @include("module-Subtasks::Partials.navbar")
    <div class="dark:bg-gray-800 bg-gray-100 border px-4 py-3 mb-4 rounded-lg shadow-sm">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-4 py-2 text-sm">Submission</th>
                                @foreach($groups as $group)
                                    <th scope="col" class="px-4 py-2 text-sm text-center">{{ $group }}</th>
                                @endforeach
                                <th scope="col" class="px-4 py-2 text-sm">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr class="border-b text-center dark:border-neutral-500">
                                    <td class="whitespace-nowrap text-left px-4 py-2 font-medium">{{ $project['name'] }}</td>
                                    @foreach($groups  as $id => $group)
                                        <td>{{ $project['groups']->has($id) ? $project['groups'][$id]->sum('points'): "0" }}</td>
                                    @endforeach
                                    <td class="font-medium">{{ $project['groups']->reduce(fn($carry, $cur) => $carry + $cur->sum('points'), 0) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
