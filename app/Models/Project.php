<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $project_id
 * @property int $task_id
 * @property string $repo_name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereRepoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $ownable_id
 * @property string|null $ownable_type
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereOwnableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereOwnableType($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\JobStatus[] $jobStatuses
 * @property-read int|null $job_statuses_count
 * @property-read Model|\Eloquent $ownable
 * @property int $verified
 * @property string|null $final_commit_sha
 * @property \Illuminate\Support\Carbon|null $finished_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Task $task
 * @method static \Illuminate\Database\Query\Builder|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereFinalCommitSha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Project withoutTrashed()
 */
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['finished_at'];

    protected $fillable = ['project_id', 'task_id', 'repo_name', 'status', 'ownable_type', 'ownable_id', 'final_commit_sha','created_at', 'finished_at'];

    public function ownable()
    {
        return $this->morphTo();
    }

    public function jobStatuses()
    {
        return $this->hasMany(JobStatus::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
