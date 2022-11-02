<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectPush extends Model
{
    use HasFactory;

    protected $fillable = ['before_sha', 'after_sha', 'ref', 'username'];

    /**
     * @return BelongsTo<Project,ProjectPush>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function download(): ProjectDownload|null
    {
        return ProjectDownload::where('project_id', $this->project_id)->where('ref', $this->after_sha)->first();
    }

    /**
     * @param  Builder<ProjectPush>  $builder
     * @return Builder<ProjectPush>
     */
    public function scopeIsValid(Builder $builder): Builder
    {
        return $builder->where('after_sha', 'NOT LIKE', '00000000000000%');
    }

    /**
     * @param  Builder<ProjectPush>  $builder
     * @param  Task  $task
     * @return Builder<ProjectPush>
     */
    public function scopeIsAccepted(Builder $builder, Task $task): Builder
    {
        return $builder->where('created_at', '<', $task->ends_at);
    }
}
