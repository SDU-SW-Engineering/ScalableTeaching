<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRole;
use App\Models\Enums\ProjectDiffIndexStatus;
use App\Models\Project;
use App\Models\ProjectDiffIndex;
use App\Models\ProjectDownload;
use App\Models\ProjectFeedback;
use App\Models\ProjectFeedbackComment;
use App\Models\Task;
use App\Models\TaskDelegation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GradingController extends Controller
{
    public function gradingDelegate(Course $course, Task $task): View
    {
        $currentlyDelegated = $task->delegations->pluck('course_role_id');
        $eligibleRoles = $course->roles->reject(function(CourseRole $role) use ($currentlyDelegated) {
            return $currentlyDelegated->contains($role->id);
        });

        return view('tasks.admin.grading.delegate', compact('eligibleRoles'));
    }

    public function addDelegation(Request $request, Course $course, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'role'               => ['required'/*Rule::in($course->roles->pluck('id')), Rule::notIn($task->delegations->pluck('course_role_id'))*/], // todo: enable when roles are better defined
            'tasks'              => ['required', 'numeric'],
            'type'               => ['required', Rule::in('last_pushes', 'succeeding_pushes', 'succeed_last_pushes')],
            'deadline_date'      => ['required', 'date'],
            'deadline_hour'      => ['required', 'date_format:H:i'],
            'options.feedback'   => ['required_without:options.grading'],
            'options.moderation' => ['required_with:options.feedback'],
        ]);

        $deadline = Carbon::parse($validated['deadline_date'] . " " . $validated['deadline_hour']);
        if($deadline->isBefore($task->ends_at))
            return back()->withInput()->withErrors('The deadline must occur after the end of the task.');

        $task->delegations()->create([
            'course_role_id'  => $validated['role'] == 'student' ? 1 : 2, // 1 = student, 2 = teahcer, todo: should reflect actual roles.
            'number_of_tasks' => $validated['tasks'],
            'type'            => $validated['type'],
            'is_moderated'    => $request->has('options.moderation'),
            'deadline_at'     => $deadline,
            'feedback'        => $request->has('options.feedback'),
            'grading'         => $request->has('options.grading'),
        ]);

        return redirect()->back();
    }

    public function removeDelegation(Request $request, Course $course, Task $task, TaskDelegation $taskDelegation): RedirectResponse
    {
        $taskDelegation->delete();

        return redirect()->back();
    }

    public function showDelegation(Course $course, Task $task, TaskDelegation $taskDelegation) : View
    {
        $taskDelegation->load('feedback.user');

        if( ! $taskDelegation->delegated)
            return view('tasks.admin.grading.showFeedbackDelegation', compact('task', 'course', 'taskDelegation'));

        $groupedByUser = $taskDelegation->getRelation('feedback')->groupBy(function(ProjectFeedback $feedback) {
            return $feedback->user_id;
        });

        $downloadDictionary = ProjectDownload::whereIn('project_id', $task->projects()->pluck('id'))
            ->whereNotNull('downloaded_at')
            ->pluck('id', 'project_id');

        $indexDictionary = ProjectDiffIndex::whereIn('project_id', $task->projects()->pluck('id'))
            ->where('from', $task->current_sha)
            ->where('status', ProjectDiffIndexStatus::Success)
            ->pluck('id', 'to');

        $users = $taskDelegation->getRelation('feedback')
            ->mapWithKeys(fn(ProjectFeedback $feedback) => [$feedback->user_id => $feedback->user]);

        return view('tasks.admin.grading.showFeedbackDelegation', compact(
            'task',
            'course',
            'taskDelegation',
            'users',
            'groupedByUser',
            'downloadDictionary',
            'indexDictionary'
        ));
    }

    public function showFeedbackModeration(Course $course, Task $task) : View
    {
        $comments = ProjectFeedbackComment::whereIn('project_feedback_id', $task->feedbacks()->pluck('project_feedback.id'))->paginate(20);

        return view('tasks.admin.grading.showFeedbackModeration')->with('comments', $comments);
    }

    public function showComment(Course $course, Task $task, ProjectFeedbackComment $comment) : ProjectFeedbackComment
    {
        $comment->load(['feedback.user', 'feedback.project']);
        $comment->code = $comment->filename == null ? null : $comment->surroundingCode()->values(); // @phpstan-ignore-line
        $comment->owner = $comment->feedback->project->ownable->name; // @phpstan-ignore-line

        return $comment;
    }
}
