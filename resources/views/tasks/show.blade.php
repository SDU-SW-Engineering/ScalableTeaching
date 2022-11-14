@extends('master')

@section('content')
    <task :task="{{ $task }}"
          @if(auth()->user()->can('editExercise', $task))
              edit-route="{{  route('courses.tasks.admin.preferences', [$course, $task]) }}"
          @else
              edit-route="{{  null }}"
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
