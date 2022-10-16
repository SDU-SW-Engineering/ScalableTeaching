@extends('tasks.admin.master')

@section('adminContent')
    @include('tasks.admin.partials.moderationTabs')

    @foreach($comments as $comment)
        <feedback-review :comment-id="{{$comment->id}}"></feedback-review>
    @endforeach
    {!! $comments->links() !!}
@endsection
