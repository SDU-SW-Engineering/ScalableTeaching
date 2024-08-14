<?php

namespace App\Modules\SubtaskGradingAndFeedback;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Course;
use App\Models\Enums\ProjectDiffIndexStatus;
use App\Models\Enums\TaskDelegationType;
use App\Models\ProjectDiffIndex;
use App\Models\ProjectDownload;
use App\Models\ProjectFeedback;
use App\Models\Task;
use App\Models\TaskDelegation;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DelegationController extends BaseController
{
    public function index(Course $course, Task $task): View
    {
        return view('module-SubtaskGradingAndFeedback::Pages.delegation.index');
    }

    public function show(Course $course, Task $task, TaskDelegation $taskDelegation): View
    {
        $taskDelegation->load('feedback.user');

        if( ! $taskDelegation->delegated)
            return view('module-SubtaskGradingAndFeedback::Pages.delegation.show', compact('task', 'course', 'taskDelegation'));

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

        return view('module-SubtaskGradingAndFeedback::Pages.delegation.show', compact(
            'task',
            'course',
            'taskDelegation',
            'users',
            'groupedByUser',
            'downloadDictionary',
            'indexDictionary'
        ));
    }

    public function delete(Course $course, Task $task, TaskDelegation $taskDelegation): RedirectResponse
    {
        if ($taskDelegation->delegated)
        {
            flash()->addError("You can not delete a delegation that has already been delegated.");

            return redirect()->back();
        }
        $taskDelegation->userPool()->detach();
        $taskDelegation->feedback()->delete();
        $taskDelegation->delete();

        return redirect()->back();
    }

    public function store(Request $request, Course $course, Task $task): RedirectResponse
    {
        Log::info("Adding delegation for task {$task->id} in course {$course->id}.");
        $maxNumberOfProjectsToDelegate = $task->projects->count() - 1; // We don't want to delegate the task to the owner.
        $validated = $request->validate([
            'role'               => ['required_if:pool,role'/*Rule::in($course->roles->pluck('id')), Rule::notIn($task->delegations->pluck('course_role_id'))*/], // todo: enable when roles are better defined
            'users'              => ['required_if:pool,user'],
            'tasks'              => ['required', 'numeric', 'min:0', "max:$maxNumberOfProjectsToDelegate"],
            'type'               => ['required', Rule::enum(TaskDelegationType::class)],
            'deadline_date'      => ['required', 'date'],
            'deadline_hour'      => ['required', 'date_format:H:i'],
            'options.feedback'   => ['required_without_all:options.moderation,options.grade'],
            'options.moderation' => ['required_without_all:options.feedback,options.grade'],
            'options.grade'      => ['required_without_all:options.feedback,options.moderation'],
            'pool'               => [Rule::in(['user', 'role'])],
        ]);

        Log::debug("Successfully validated delegation request");

        $deadline = Carbon::parse($validated['deadline_date'] . " " . $validated['deadline_hour']);
        if($deadline->isBefore($task->ends_at))
            return back()->withInput()->withErrors('The deadline must occur after the end of the task.');

        try
        {
            /** @var TaskDelegation $delegation */
            $delegation = $task->delegations()->create([
                'course_role_id'     => $validated['pool'] == 'role' ? ($validated['role'] == 'student' ? 1 : 2) : null, // 1 = student, 2 = teacher, todo: should reflect actual roles.
                'number_of_projects' => $validated['tasks'],
                'type'               => $validated['type'],
                'is_moderated'       => $request->has('options.moderation'),
                'deadline_at'        => $deadline,
                'feedback'           => $request->has('options.feedback'),
                'grading'            => $request->has('options.grade'),
            ]);

            if($validated['pool'] == 'user')
                $delegation->userPool()->attach($validated['users']);

            return redirect()->back();
        } catch (QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return redirect()->back()->withInput()->withErrors('The selected role has already been delegated to.');
            }
            Log::error('An error occurred while delegating the task.', ['exception' => $e]);

            return redirect()->back()->withInput()->withErrors("An error occurred while delegating the task.");
        }
    }
}
