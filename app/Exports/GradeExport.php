<?php

namespace App\Exports;

use App\Models\Task;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GradeExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @param  Collection<int,Task>  $tasks
     */
    public function __construct(private readonly Collection $tasks)
    {
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->tasks as $task) {
            $sheets[] = new TaskGradeExport($task);
        }

        return $sheets;
    }
}
