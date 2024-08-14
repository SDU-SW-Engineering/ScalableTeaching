@php
    $feedbackRouteBase = "courses.tasks.admin.subtaskGradingAndFeedback.feedback.";
    $feedbackFolderBase = "module-SubtaskGradingAndFeedback::Pages.feedback."
@endphp

@extends('tasks.admin.master')

@section('adminContent')
    @include($feedbackFolderBase . "partials.tabs")

    @forelse($comments as $comment)
        <feedback-review :show-overlay="{{ json_encode($overlay) }}"
                         base-path="{{ route($feedbackRouteBase . 'getComment', [$course, $task, $comment]) }}"
                         :comment-id="{{ $comment->id }}"></feedback-review>
    @empty
        <div class="flex w-full items-center justify-center font-thin text-4xl dark:text-gray-400 mt-12">
            All feedback has been reviewed for now, good job!
        </div>
    @endforelse
    {!! $comments->links() !!}
@endsection
