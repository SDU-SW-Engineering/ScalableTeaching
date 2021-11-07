<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Database\Eloquent\Collection;
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

    protected $casts = [
        'validation_errors' => 'array'
    ];

    protected $hidden = ['final_commit_sha', 'validation_errors', 'validated_at'];

    protected $fillable = [
        'project_id', 'task_id', 'repo_name', 'status', 'ownable_type', 'ownable_id',
        'final_commit_sha', 'created_at', 'finished_at', 'validation_errors', 'validated_at'
    ];

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

    public function refreshGitlabAccess()
    {
        $gitLabManager   = app(GitLabManager::class);
        $supposedMembers = $this->owners()->map(function ($user) use ($gitLabManager)
        {
            $users = $gitLabManager->users()->all([
                'username' => $user->username
            ]);
            if (count($users) == 1)
                return $users[0]['id'];
            return null;
        })->reject(function ($gitlabId)
        {
            return $gitlabId == null;
        });
        $currentMembers  = collect($gitLabManager->projects()->members($this->project_id))->pluck('id');
        $add             = $supposedMembers->diff($currentMembers);
        $remove          = $currentMembers->diff($supposedMembers);
        $this->addUsersToGitlab($add);
        $remove->each(function ($gitlabUserId) use ($gitLabManager)
        {
            try
            {
                $gitLabManager->projects()->removeMember($this->project_id, $gitlabUserId);
            }
            catch (\Exception $ignored)
            {

            }
        });
    }

    /**
     * returns a collection of users that own the project
     * @return Collection
     */
    public function owners()
    {
        if ($this->ownable_type == User::class)
            return Collection::wrap($this->ownable);
        return $this->ownable->users()->get();
    }

    public function addUsersToGitlab($gitlabIds, &$errors = [])
    {
        foreach ($gitlabIds as $user => $gitlabId)
        {
            $gitLabManager = app(GitLabManager::class);
            try
            {
                $gitLabManager->projects()->addMember($this->project_id, $gitlabId, 30);
            }
            catch (\Exception $e)
            {
                $message = strtolower($e->getMessage());
                if (\Str::contains($message, 'should be greater than or equal to'))
                    continue;
                if ($message == 'member already exists')
                    continue;

                $errors[] = "$user: " . $e->getMessage();
            }
        }
    }

    public function unprotectBranches()
    {
        $gitLabManager = app(GitLabManager::class);
        $tries         = 3;
        do
        {
            sleep(1);  // todo: this should be switched out with a queue worker that is delayed
            $project = $gitLabManager->projects()->show($this->project_id);
            if ($project['import_error'] != null)
                break;
            if ($project['import_status'] == 'finished')
            {
                $protectedBranches = collect($gitLabManager->projects()->protectedBranches($this->project_id));
                $protectedBranches->each(function ($protectedBranch) use ($gitLabManager)
                {
                    $gitLabManager->repositories()->unprotectBranch($this->project_id, $protectedBranch['name']);
                });
                break;
            }
            $tries--;
        }
        while ($tries != 0);
    }

    public function disableForking()
    {
        $gitLabManager = app(GitLabManager::class);
        $tries         = 3;
        do
        {
            sleep(1);  // todo: this should be switched out with a queue worker that is delayed
            $project = $gitLabManager->projects()->show($this->project_id);
            if ($project['import_error'] != null)
                break;
            if ($project['import_status'] == 'finished')
            {
                $gitLabManager->projects()->update($this->project_id, [
                    'forking_access_level' => 'disabled'
                ]);
                break;
            }
            $tries--;
        }
        while ($tries != 0);
    }

    public function getDurationAttribute()
    {
        if ($this->finished_at == null)
            return null;

        return number_format($this->created_at->diffInHours($this->finished_at) / 24, 2);
    }

    public function dailyBuilds($withToday = false) : \Illuminate\Support\Collection
    {
        return $this->jobStatuses()->daily($this->task->starts_at->startOfDay(), $this->task->earliestEndDate(! $withToday))->get();
    }

    public function getValidationStatusAttribute()
    {
        if ($this->validated_at == null)
            return "pending";
        if (count($this->validation_errors) > 0)
            return "failed";
        return "success";
    }
}
