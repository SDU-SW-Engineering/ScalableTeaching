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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
