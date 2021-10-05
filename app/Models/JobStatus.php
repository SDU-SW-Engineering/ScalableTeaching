<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\JobStatus
 *
 * @property int $id
 * @property int $build_id
 * @property int $project_id
 * @property string $status
 * @property string $repo_name
 * @property string $repo_branch
 * @property string|null $runner
 * @property string|null $duration
 * @property string|null $queue_duration
 * @property array $history
 * @property array $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereBuildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereQueueDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereRepoBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereRepoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereRunner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobStatus extends Model
{
    use HasFactory;

    protected $casts = [
        'history' => 'array',
        'log'     => 'array'
    ];
}
