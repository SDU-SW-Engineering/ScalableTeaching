<?php

namespace App\Models;

use App\Models\Enums\PipelineStatusEnum;
use Carbon\CarbonInterval;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\JobStatus
 *
 * @property int $id
 * @property int $build_id
 * @property int $project_id
 * @property PipelineStatusEnum $status
 * @property string $repo_name
 * @property string $repo_branch
 * @property string|null $runner
 * @property string|null $duration
 * @property string|null $queue_duration
 * @property array $history
 * @property array $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereBuildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereQueueDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereRepoBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereRepoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereRunner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $user_name
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pipeline whereUserName($value)
 */
class Pipeline extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'pipeline_id', 'status', 'user_name', 'runners', 'queue_duration', 'created_at'];

    protected $casts = [
        'status'  => PipelineStatusEnum::class,
        'runners' => 'json'
    ];

    public static $upgradable = [
        'pending' => [PipelineStatusEnum::Running, PipelineStatusEnum::Failed, PipelineStatusEnum::Success],
        'running' => [PipelineStatusEnum::Failed, PipelineStatusEnum::Success],
    ];

    public function isUpgradable(PipelineStatusEnum $to): bool
    {
        if(!array_key_exists($this->status->value, static::$upgradable))
            return false;
        return in_array($to, static::$upgradable[$this->status->value]);
    }

    public function scopeFinished(Builder $query)
    {
        $query->where('status', 'finished');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getRunTimeAttribute()
    {
        return CarbonInterval::seconds($this->duration)->forHumans();
    }

    public function getQueuedForAttribute()
    {
        return CarbonInterval::seconds($this->queue_duration)->forHumans();
    }
}
