@extends('master')

@section('content')
    @include('partials.subnavbar', ['title' => $task->name, 'previousRoute' => route('courses.show', $task->course_id)])
    <task description="{{ $task->description }}" :project="{{ is_null($project) ? 'null' : $project}}" :progress="{{ json_encode($progress) }}"
          :build-graph="{{ collect($buildGraph) }}" :total-builds="{{ $builds->sum() }}" :total-my-builds="{{ $myBuilds->sum() }}" csrf="{{ csrf_token() }}" new-project-url="{{ $newProjectRoute }}"></task>
@endsection
