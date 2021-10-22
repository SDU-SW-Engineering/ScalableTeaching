<?php

namespace App\Models;

use GrahamCampbell\GitLab\GitLabManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property string|null $description
 * @property string|null $starts_at
 * @property string $ends_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCourseId($value)
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereEndsAt($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereName($value)
 * @method static Builder|Task whereStartsAt($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $source_project_id
 * @property string|null $short_description
 * @property string|null $markdown_description
 * @method static Builder|Task whereMarkdownDescription($value)
 * @method static Builder|Task whereShortDescription($value)
 * @method static Builder|Task whereSourceProjectId($value)
 * @property-read Collection|Project[] $projects
 * @property-read int|null $projects_count
 * @property-read mixed $projects_per_day
 * @property-read mixed $total_completed_tasks_per_day
 * @property-read mixed $total_projects_per_day
 * @property-read Collection|\App\Models\JobStatus[] $jobs
 * @property-read int|null $jobs_count
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'markdown_description'];

    protected $dates = ['ends_at', 'starts_at'];

    public function reloadDescriptionFromRepo()
    {
        $gitlabManager = app(GitLabManager::class);
        $project       = $gitlabManager->projects()->show($this->source_project_id);
        $branch        = $project['default_branch'];
        $readme        = base64_decode($gitlabManager->repositoryFiles()->getFile($this->source_project_id, 'README.md', $branch)['content']);
        $parseDown     = new \Parsedown();
        $htmlReadme    = $parseDown->parse($readme);

        $this->update([
            'description'          => $htmlReadme,
            'markdown_description' => $readme
        ]);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function jobs()
    {
        return $this->hasManyThrough(JobStatus::class, Project::class);
    }

    public function dailyBuilds(?int $owner = null, bool $withTrash = false, $withToday = false) : \Illuminate\Support\Collection
    {
        $query = $this->jobs();

        if ($owner != null)
            $query->where('projects.ownable_id', $owner);
        if ($withTrash)
            $query->withTrashedParents();

        return $query->daily($this->starts_at->startOfDay(), $this->earliestEndDate(! $withToday))->get();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getProjectsPerDayAttribute()
    {
        return $this->projects()->daily($this->starts_at, $this->earliestEndDate())->get();
    }

    public function getTotalProjectsPerDayAttribute()
    {
        return $this->projects()->daily($this->starts_at, $this->earliestEndDate())->total();
    }

    public function getTotalCompletedTasksPerDayAttribute()
    {
        return $this->projects()
            ->withTrashed()
            ->where('status', 'finished')
            ->daily($this->starts_at, $this->earliestEndDate(), 'finished_at')
            ->total();
    }

    private function earliestEndDate($excludeToday = false)
    {
        return now()->isAfter($this->ends_at) ? $this->ends_at : ($excludeToday ? now()->subDay() : now());
    }

    public function currentProjectForUser(User $user) : ?Project
    {
        $myGroups     = $this->course->groups()
            ->whereRelation('users', 'user_id', $user->id)
            ->latest()
            ->pluck('name', 'id');
        $groupProject = $this->projects()->whereHasMorph('ownable', Group::class, function (Builder $query) use ($myGroups)
        {
            $query->whereIn('id', $myGroups->keys());
        })->first();

        if ($groupProject != null)
            return $groupProject;

        /** @var Project $project */
        $project = $user->projects()->whereHasMorph('ownable', User::class, function (Builder $query) use ($user, $myGroups)
        {
            $query->where('id', $user->id);
        })->first();

        return $project;
    }

    /**
     * @param Collection $users
     * @return Collection
     */
    public function progressStatus(Collection $users) : Collection
    {
        return $users->filter(function (User $user)
        {
            return $this->currentProjectForUser($user) != null;
        });
    }

    public function projectsForUsers(Collection $users) : Collection
    {
        $projects = Collection::empty();
        $users->each(function (User $user) use ($projects)
        {
            $project = $this->currentProjectForUser($user);
            if ($project == null)
                return;
            $projects[] = $project;
        });

        return $projects;
    }
}
