<?php

namespace App\Modules\SubtaskGradingAndFeedback;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Enums\FeedbackCommentStatus;
use App\Models\Project;
use App\Models\ProjectFeedbackComment;
use App\Models\Task;
use Illuminate\View\View;
use function request;


class FeedbackController extends BaseController
{
    public function index(Course $course, Task $task): View
    {
        $commentsQuery = ProjectFeedbackComment::query();
        if(request('filter') != null)
        {
            $commentsQuery->whereHas('feedback', fn($query) => $query->where('project_id', request('filter')));
        }

        $commentStatusToQuery = request('reviewed') == null ? [FeedbackCommentStatus::Pending] : [FeedbackCommentStatus::Approved, FeedbackCommentStatus::Rejected];
        $comments = $commentsQuery->whereIn('project_feedback_id', $task->feedbacks()->pluck('project_feedback.id'))
            ->whereIn('status', $commentStatusToQuery)->paginate(20);
        $projectNames = $task->projects->mapWithKeys(fn(Project $project) => [$project->id => $project->ownable->name])->sort();

        return view('module-SubtaskGradingAndFeedback::Pages.feedback.index')->with('comments', $comments)->with('overlay', request('reviewed') == null)->with('projectNames', $projectNames);
    }

    public function getComment(Course $course, Task $task, ProjectFeedbackComment $comment): ProjectFeedbackComment
    {
        $comment->load(['feedback.user', 'feedback.project', 'reviewer']);
        $comment->append('reviewed_time_since');
        $comment->code = $comment->filename == null ? null : $comment->surroundingCode()->values(); // @phpstan-ignore-line
        $comment->owner = $comment->feedback->project->ownable->name; // @phpstan-ignore-line
        $comment->code_all = $comment->filename == null ? null : $comment->lines()->values(); // @phpstan-ignore-line

        return $comment;
    }

    public function setCommentStatus(Course $course, Task $task, ProjectFeedbackComment $comment): string
    {
        $comment->update([
            'status'            => FeedbackCommentStatus::from(\request('status')),
            'reviewer_feedback' => \request('reason'),
            'reviewer_id'       => auth()->id(),
            'reviewed_at'       => now(),
        ]);

        return "ok";
    }

}
