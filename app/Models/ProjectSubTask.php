<?php

namespace App\Models;

use App\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectSubTask extends Model
{
    use HasFactory;

    protected $fillable = ['sub_task_id', 'pipeline_id'];

    protected static function booted()
    {
        static::created(function (ProjectSubTask $projectSubTask)
        {
            $project = $projectSubTask->project;
            $requiredSubTasks = collect($project->task->sub_tasks)->pluck('id');
            $completed = $project->subtasks()->pluck('sub_task_id');
            $missing = $requiredSubTasks->diff($completed);
            if ($requiredSubTasks->count() == 0)
                return;

            if ($missing->count() > 0)
                return;
            $project->update([
                'status' => ProjectStatus::Finished
            ]);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
