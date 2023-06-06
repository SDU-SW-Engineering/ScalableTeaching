<?php

namespace App\Exports;

use App\Models\Casts\SubTask;
use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SubtaskCompletionExport implements FromQuery, WithTitle, WithMapping, WithHeadings
{
    private Collection $subTasks;

    public function __construct(private Task $task)
    {
        $this->subTasks = $this->task->sub_tasks->all()
            ->pluck('name', 'id');
    }

    public function title(): string
    {
        return "{$this->task->name} Subtask Completion";
    }


    public function query()
    {
        return $this->task->projects()->with('subTasks')->claimed();
    }

    public function prepareRows($rows)
    {
        return $rows->sortBy('ownerNames');
    }

    /** @noinspection PhpParameterNameChangedDuringInheritanceInspection */
    public function map($project): array
    {
        /** @var Collection $completedSubtasks */
        $completedSubtasks = $project->subTasks->pluck('points', 'sub_task_id');
        $subTaskPoints = $this->subTasks->map(fn($name, $id) => $completedSubtasks->has($id) ? (string)$completedSubtasks[$id] : '0');
        $totalPoints = $subTaskPoints->sum();

        return [
            $project->ownerNames,
            ...$subTaskPoints,
            (string)$totalPoints,
        ];
    }

    public function headings(): array
    {
        return [
            'Submission',
            ...$this->subTasks,
            'Total',
        ];
    }
}
