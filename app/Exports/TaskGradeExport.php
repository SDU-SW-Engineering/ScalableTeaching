<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TaskGradeExport implements WithTitle, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    public function __construct(private readonly Task $task)
    {
    }

    public function title(): string
    {
        return $this->task->name;
    }

    /**
     * @return HasMany<Project>
     */
    public function query(): HasMany
    {
        return $this->task->projects()->where('status', 'finished');
    }

    public function map($row): array
    {
        $gradedBy = $row->gradeDelegations()->with(['user' => function (BelongsTo $query) {
            $query->select('id', 'name');
        }])->get();
        $points = $row->subTasks->sum('points');

        $name = $row->owners()->pluck('name')->implode(', ');

        return [
            $name,
            (string) $points,
            $gradedBy->pluck('user.name')->implode(', '),
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Points',
            'Graded by',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
