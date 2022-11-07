@extends('master')

@section('content')
    <task :task="{{ $task }}"
          @if(auth()->user()->is_admin ==  1)
              edit-route="{{  route('courses.tasks.admin.preferences', [$course, $task]) }}"
              analytics="{{  route('courses.tasks.admin.index', [$course, $task]) }}"
          @elseif(auth()->user()->is_admin == 0)
              edit-route="{{  null }}"
              analytics="{{  null }}"
          @endif
          code-route="{{ $codeRoute }}"
          :grade="{{ $task->grade(auth()->user()) ?? 'null' }}"
          :survey="{{ json_encode($survey) }}"
          :sub-tasks="{{ json_encode($subTasks) }}" :project="{{ is_null($project) ? 'null' : $project}}"
          :progress="{{ json_encode($progress) }}"
          :build-graph="{{ collect($buildGraph) }}" :pushes="{{ json_encode($pushes) }}"
          warning="{{ session()->has('warning') ? session('warning') : '' }}" :groups="{{ $availableGroups }}"
          user-name="{{ auth()->user()->name }}" :total-builds="{{ $builds->sum() }}"
          :total-my-builds="{{ $myBuilds->sum() }}" csrf="{{ csrf_token() }}"
          new-project-url="{{ $newProjectRoute }}"></task>
@endsection
