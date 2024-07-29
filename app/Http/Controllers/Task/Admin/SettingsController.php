<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Casts\SubTask;
use App\Models\Course;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\Models\Task;
use Domain\GitLab\CIReader;
use Domain\GitLab\CITask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Spatie\LaravelMarkdown\MarkdownRenderer;

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

        $startsAt = $task->starts_at?->toDateTimeLocalString();
        $endsAt = $task->ends_at?->toDateTimeLocalString();

        return view('tasks.admin.preferences', compact('startsAt', 'endsAt'));
    }

    public function savePreferences(Course $course, Task $task)
    {
        $validated = request()->validateWithBag('duration', [
            'title'    => ['max:255'],
            'startsAt' => ['date', 'nullable', 'before_or_equal:endsAt'],
            'endsAt'   => ['date', 'nullable', 'after_or_equal:startsAt'],
            'markdown' => ['string', 'nullable'],
        ]);

        $markdown = request('markdown');
        if($markdown != "")
        {
            $html = app(MarkdownRenderer::class)->toHtml($markdown);
            $task->markdown_description = $markdown;
            $task->description = $html;
        }

        $task->name = $validated['title'];
        $task->starts_at = $validated['startsAt'];
        $task->ends_at = $validated['endsAt'];
        $task->save();

        return "OK";
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
