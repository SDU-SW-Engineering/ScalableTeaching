<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Task;
use Carbon\Carbon;
use Domain\GitLab\CIReader;
use Domain\GitLab\CITask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function preferences(Course $course, Task $task): View
    {
        if($task->type == TaskTypeEnum::Assignment)
        {
            $ciFile = $task->ciFile();
            $subTasks = $ciFile == null ? null : $this->getSubTasks($ciFile, $task);

            return view('tasks.admin.preferences', compact('subTasks', 'task'));
        }

        return view('tasks.admin.preferences');
    }

    public function saveDescription(Course $course, Task $task): string
    {
        $markdown = request('markdown');
        $html = Http::post(getenv('FORMATTER_SERVICE_URL') . '/md', ['text' => $markdown])->json('html');

        $task->description = $html;
        $task->markdown_description = $markdown;
        $task->save();

        return "OK";
    }

    public function loadDescription(Course $course, Task $task): string
    {
        if ( ! $task->reloadDescriptionFromRepo())
            return redirect()->back()->with('error', 'No readme file to load.');

        return redirect()->back();
    }

    public function updateTitle(Course $course, Task $task): RedirectResponse
    {
        $validated = request()->validateWithBag('title', [
            'title' => 'required',
        ]);

        $task->update(['name' => $validated['title']]);

        return back()->with('title-success', 'Changes saved');
    }

    public function updateDuration(Course $course, Task $task): RedirectResponse
    {
        $validated = request()->validateWithBag('duration', [
            'from'       => ['required', 'date', 'before_or_equal:to'],
            'to'         => ['required', 'date', 'after_or_equal:from'],
            'start-time' => ['required', 'date_format:H:i'],
            'end-time'   => ['required', 'date_format:H:i'],
        ]);

        $from = Carbon::parse($validated['from'] . " " . $validated['start-time']);
        $to = Carbon::parse($validated['to'] . " " . $validated['end-time']);

        if($from->isAfter($to) || $from->eq($to))
            return back()->withInput()->withErrors('The from date must happen before the to date.', 'duration');

        $task->update([
            'starts_at' => $from,
            'ends_at'   => $to,
        ]);

        return back()->with('duration-success', 'Changes saved');
    }

    public function toggleVisibility(Course $course, Task $task): string
    {
        $task->is_visible = ! $task->is_visible;
        $task->save();

        return "ok";
    }

    public function updateSubtasks(Course $course, Task $task): string
    {
        $tasks = new Collection(request('tasks'));
        $correctionType = CorrectionType::from(request('correctionType'));

        $selected = $tasks->filter(fn($task) => $task['isSelected']);
        $currentSubTasks = $task->sub_tasks;
        $removeIds = $task->sub_tasks->all()->map(fn(SubTask $subTask) => $subTask->getId())->diff($selected->pluck('id'));
        $currentSubTasks->remove($removeIds->toArray());
        $selected->each(function($task) use ($currentSubTasks) {
            $subTask = (new SubTask($task['name'], $task['alias'] == '' ? null : $task['alias']))
                ->setPoints($task['points'])
                ->setIsRequired($task['required']);
            if($task['id'] == null)
                $currentSubTasks->add($subTask);
            else
                $currentSubTasks->update($task['id'], $subTask);

        });
        $task->correction_type = $correctionType;
        $task->correction_points_required = request('requiredPoints');
        $task->correction_tasks_required = request('requiredTasks');
        $task->save();

        return "OK";
    }

    /**
     * @param string|null $ciFile
     * @param Task $task
     * @return mixed[]
     */
    private function getSubTasks(?string $ciFile, Task $task): array
    {
        $subTasks = collect((new CIReader($ciFile))->tasks())->map(fn(CITask $task) => [
            'stage'      => $task->getStage(),
            'name'       => $task->getName(),
            'id'         => null,
            'alias'      => '',
            'points'     => 0,
            'isRequired' => false,
            'isSelected' => false,
        ])->toArray();


        /** @var SubTask $subTask */
        foreach($task->sub_tasks->all() as $subTask)
        {
            $found = collect($subTasks)->search(fn($t) => $t['name'] == $subTask->getName() || $t['id'] == $subTask->getId());
            if($found === false)
                continue;
            $subTasks[$found]['name'] = $subTask->getName();
            $subTasks[$found]['alias'] = $subTask->getAlias();
            $subTasks[$found]['id'] = $subTask->getId();
            $subTasks[$found]['points'] = $subTask->getPoints();
            $subTasks[$found]['isRequired'] = $subTask->isRequired();
            $subTasks[$found]['isSelected'] = true;
        }

        return $subTasks;
    }
}
