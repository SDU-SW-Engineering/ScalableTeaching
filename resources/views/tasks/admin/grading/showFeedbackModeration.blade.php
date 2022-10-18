@extends('tasks.admin.master')

@section('adminContent')
    @include('tasks.admin.partials.moderationTabs')

    @forelse($comments as $comment)
        <feedback-review :show-overlay="{{ json_encode($overlay) }}" base-path="{{ route('courses.tasks.admin.feedback.moderation.show-comment', [$course, $task, $comment]) }}" :comment-id="{{$comment->id}}"></feedback-review>
    @empty
        <div class="flex w-full items-center justify-center font-thin text-4xl dark:text-gray-400">
            Queue is empty
        </div>
    @endforelse
    {!! $comments->links() !!}
@endsection
