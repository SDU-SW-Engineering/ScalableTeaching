<?php

namespace App\Http\Controllers\Course\Management;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Domain\Analytics\Graph\DataSets\BarDataSet;
use Domain\Analytics\Graph\DataSets\LineDataSet;
use Domain\Analytics\Graph\Graph;
use Domain\SourceControl\SourceControl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class OverviewController extends Controller
{
    public function index(Course $course): View
    {
        /** @var Collection<string,int> $exerciseEngagement */
        $exerciseEngagement = $course->task_engagement;
        $userEngagementGraph = $exerciseEngagement == null ? null : new Graph(
            $exerciseEngagement->keys(),
            new BarDataSet("Engagement %", $exerciseEngagement->values(), "#4F535B"),
        );


        /** @var Collection<string,int> $enrolmentPerDay */
        $enrolmentPerDay = $course->enrolment_per_day;
        $enrolmentPerDayGraph = new Graph(
            $enrolmentPerDay->keys(),
            new LineDataSet("Enrolled in total", $enrolmentPerDay->values(), "#266ab0", true)
        );

        $activities = $course->activities()->take(10)->get();

        return view('courses.manage.index', [
            'course'              => $course,
            'userEngagementGraph' => $userEngagementGraph,
            'enrolmentGraph'      => $enrolmentPerDayGraph,
            'activities'          => $activities,
        ]);
    }


    /**
     * @throws \Throwable
     */
    public function store(Course $course, Request $request, SourceControl $sourceControl): array|RedirectResponse
    {
        $validated = request()->validate([
            'name'  => 'required',
            'group' => ['string', 'nullable'],
        ]);


        /** @var Task $task */
        $task = $course->tasks()->create([
            'name'       => $validated['name'],
            'grouped_by' => $request->has('group') ? $validated['group'] : null,
        ]);

        return [
            'id'    => $task->id,
            'route' => route('courses.tasks.admin.preferences', [$course->id, $task->id]),
        ];

        /** @var Task $task */
        /*$task = $course->tasks()->create([
            'source_project_id' => $sourceId,
            'name'              => $validated['name'],
            'type'              => $validated['type'],
            'gitlab_group_id'   => $groupId,
            'correction_type'   => $validated['type'] == 'exercise' ? 'self' : null,
        ]);

        return [
            'id'    => $task->id,
            'route' => route('courses.tasks.admin.preferences', [$course->id, $task->id]),
        ];*/
    }
}
