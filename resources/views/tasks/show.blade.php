@extends('master')

@section('content')
    <task :task="{{ $task }}" :sub-tasks="{{ json_encode($subTasks) }}" :project="{{ is_null($project) ? 'null' : $project}}" :progress="{{ json_encode($progress) }}"
          :build-graph="{{ collect($buildGraph) }}" warning="{{ session()->has('warning') ? session('warning') : '' }}" :groups="{{ $availableGroups }}" user-name="{{ auth()->user()->name }}" :total-builds="{{ $builds->sum() }}" :total-my-builds="{{ $myBuilds->sum() }}" csrf="{{ csrf_token() }}" new-project-url="{{ $newProjectRoute }}"></task>
@endsection
