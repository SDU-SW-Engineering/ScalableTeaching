@extends('tasks.admin.master')

@section('adminContent')
    <div class="bg-white border rounded p-4">
        <h1 class="flex items-center text-xl">Files</h1>
        <p class="mb-4 text-sm text-blue-400">List of files submitted by students. The list is exhaustive.</p>
        <form action="{{ route('courses.tasks.admin.plagiarismDetection.files', [$course, $task]) }}" method="post">
            @csrf
            <div class="flex mb-4 flex-col">
                <div class="flex w-full items-center border border-gray-300">
                    <div class="w-4/12 ml-2 py-2">
                        File
                    </div>
                    <div class="w-2/12 text-center">
                        Observations
                    </div>
                    <div class="w-6/12 text-center">
                        Quartiles
                    </div>
                </div>
                @foreach($files as $fileName => $percentiles)
                    <div class="flex w-full items-center border border-gray-300 @if($hiddenFiles->contains($fileName)) opacity-50 @endif">
                        <div class="w-5/12 ml-2 py-2">
                            <input id="hide-{{$fileName}}" type="checkbox" name="hide[{{$fileName}}]" @if($hiddenFiles->contains($fileName)) checked @endif />
                            <label for="hide-{{$fileName}}">{{ $fileName }}</label>
                        </div>
                        <div class="w-1/12">{{ $percentiles['observations'] }}</div>
                        <div class="w-6/12 flex-shrink-0 relative border-l border-r border-gray-300">
                            <div class="bg-lime-green-300 h-2 absolute top-0 bottom-0 mb-auto mt-auto"
                                 style="left: {{$percentiles[25]}}%;width: {{$percentiles[50]-$percentiles[25]}}%"></div>
                            <div class="bg-lime-green-500 h-2 absolute top-0 bottom-0 mb-auto mt-auto"
                                 style="left: {{$percentiles[50]}}%;width: {{$percentiles[75]-$percentiles[50]}}%"></div>
                            <div class="bg-gray-600 h-0.5 absolute top-0 bottom-0 mb-auto mt-auto"
                                 style="left: {{$percentiles['min']}}%;width: {{$percentiles[25]-$percentiles['min']}}%"></div>
                            <div class="bg-gray-600 h-0.5 absolute top-0 bottom-0 mb-auto mt-auto"
                                 style="left: {{$percentiles[75]}}%;width: {{$percentiles['max']-$percentiles[75]}}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="bg-lime-green-400 text-white rounded-sm hover:bg-lime-green-500 px-3 py-2" type="submit">Hide selected</button>
        </form>
    </div>
@endsection
