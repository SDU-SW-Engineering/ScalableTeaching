<?php

namespace App\Models;

use DB;
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

    public function jobs()
    {
        return $this->hasManyThrough(JobStatus::class, Project::class);
    }

    public function dailyBuilds(?int $owner = null, bool $withTrash = false) : \Illuminate\Support\Collection
    {
        $query = $this->jobs()
            ->select(
                DB::raw('count(*) as c'),
                DB::raw('day(`job_statuses`.`created_at`) as created_at_day'),
                DB::raw('month(`job_statuses`.`created_at`) as created_at_month'),
                DB::raw('year(`job_statuses`.`created_at`) as created_at_year'))
            ->groupBy('created_at_day', 'created_at_month', 'created_at_year', 'laravel_through_key');

        if ($owner != null)
            $query->where('projects.ownable_id', $owner);
        if ($withTrash)
            $query->withTrashedParents();

        $allBuilds = $query->get()->mapWithKeys(function ($task)
        {
            return ["$task->created_at_year-$task->created_at_month-$task->created_at_day" => $task->c];
        });

        $builds = collect();
        foreach ($this->starts_at->daysUntil(now()) as $day)
        {
            /** @var Carbon $day */
            $date = $day->format('Y-n-j');
            if ($day->isToday())
                continue;
            $builds[] = $allBuilds->has($date) ? $allBuilds[$date] : 0;
        }

        return $builds;
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
