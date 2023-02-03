<?php

namespace App\Http\Controllers\Course\Management;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function exercises(Course $course): View
    {
        $groups = $course->tasks()->exercises()->orderBy('order')->get()->groupBy('grouped_by')->map(fn ($exercises, $groupName) => [
            'name' => $groupName == '' ? null : $groupName,
            'editing' => false,
            'exercises' => $exercises->map(fn (Task $exercise) => [
                'id' => $exercise->id,
                'name' => $exercise->name,
                'visible' => $exercise->is_visible,
                'manage' => route('courses.tasks.admin.index', [$course, $exercise]),
            ]),
        ])->values();

        $reorganizeRoute = route('courses.manage.exercises.reorganize', $course);

        return view('courses.manage.exercises', compact('groups', 'reorganizeRoute'));
    }

    public function reorganizeExercises(Course $course): string
    {
        $validated = request()->validate([
            '*.group' => ['string', 'nullable'],
            '*.id' => ['numeric', 'required'],
        ]);

        $course->tasks()->exercises()->update([
            'order' => null,
            'grouped_by' => null,
        ]);
        $exercises = new Collection($validated);
        /** @var Collection<int,int> $allowedIds */
        $allowedIds = $course->tasks()->exercises()->pluck('id');
        abort_if($exercises->pluck('id')->diff($allowedIds)->count() > 0, 400);

        foreach ($exercises as $index => $exercise) {
            Task::where('id', $exercise['id'])->update([
                'grouped_by' => $exercise['group'],
                'order' => $index + 1,
            ]);
        }

        return 'ok';
    }
}
