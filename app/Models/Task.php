<?php

namespace App\Models;

use App\Models\Enums\GradeEnum;
use GrahamCampbell\GitLab\GitLabManager;
use GraphQL\Client;
use GraphQL\SchemaObject\ProjectRepositoryArgumentsObject;
use GraphQL\SchemaObject\RepositoryTreeArgumentsObject;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'markdown_description', 'source_project_id', 'name',
        'short_description', 'starts_at', 'ends_at', 'gitlab_group_id'
    ];

    protected $dates = ['ends_at', 'starts_at'];

    protected $casts = ['is_visible' => 'bool'];

    public function reloadDescriptionFromRepo()
    {
        $gitlabManager = app(GitLabManager::class);
        $project = $gitlabManager->projects()->show($this->source_project_id);
        $branch = $project['default_branch'];
        $readme = base64_decode($gitlabManager->repositoryFiles()->getFile($this->source_project_id, 'README.md', $branch)['content']);
        $parseDown = new \Parsedown();
        $htmlReadme = $parseDown->parse($readme);

        $this->update([
            'description' => $htmlReadme,
            'markdown_description' => $readme
        ]);
    }

    // region relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function jobs()
    {
        return $this->hasManyThrough(JobStatus::class, Project::class)->withTrashedParents();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    // endregion

    public function dailyBuilds(bool $withTrash = false, $withToday = false): \Illuminate\Support\Collection
    {
        $query = $this->jobs();
        if ($withTrash)
            $query->withTrashedParents();
        return $query->daily($this->starts_at->startOfDay(), $this->earliestEndDate(!$withToday))->get();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function protectedFiles()
    {
        return $this->hasMany(TaskProtectedFile::class);
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

    public function earliestEndDate($excludeToday = false)
    {
        return now()->isAfter($this->ends_at) ? $this->ends_at : ($excludeToday ? now()->subDay() : now());
    }

    public function currentProjectForUser(User $user): ?Project
    {
        $myGroups = $this->course->groups()
            ->whereRelation('users', 'user_id', $user->id)
            ->latest()
            ->pluck('name', 'id');
        $groupProject = $this->projects()->whereHasMorph('ownable', Group::class, function (Builder $query) use ($myGroups) {
            $query->whereIn('id', $myGroups->keys());
        })->first();

        if ($groupProject != null)
            return $groupProject;

        /** @var Project $project */
        return $this->projects()->whereHasMorph('ownable', User::class, function (Builder $query) use ($user, $myGroups) {
            $query->where('id', $user->id);
        })->first();
    }

    /**
     * @param Collection $users
     * @return Collection
     */
    public function progressStatus(Collection $users): Collection
    {
        return $users->filter(function (User $user) {
            return $this->currentProjectForUser($user) != null;
        });
    }

    public function projectsForUsers(Collection $users): Collection
    {
        $projects = Collection::empty();
        $users->each(function (User $user) use ($projects) {
            $project = $this->currentProjectForUser($user);
            if ($project == null)
                return;
            $projects[] = $project;
        });

        return $projects;
    }

    public function loadShaValuesFromDirectory(string $dir = "", ?string $selectFile = null)
    {
        $rootObject = new RootQueryObject();
        $rootObject->selectProjects((new RootProjectsArgumentsObject())
            ->setIds(["gid://gitlab/Project/$this->source_project_id"])
            ->setFirst(1))
            ->selectNodes()
            ->selectRepository()
            ->selectTree((new RepositoryTreeArgumentsObject())->setPath($dir))
            ->selectBlobs()
            ->selectNodes()
            ->selectName()
            ->selectSha();
        $client = new Client('https://gitlab.sdu.dk/api/graphql', ["Authorization" => 'Bearer ' . env('GITLAB_ACCESS_TOKEN')]);
        $projects = $client->runQuery($rootObject->getQuery())->getResults()->data->projects->nodes;
        if (count($projects) == 0)
            return;

        collect($projects[0]->repository->tree->blobs->nodes)->each(function ($repoFile) use ($selectFile, $dir) {
            if ($selectFile != null && $repoFile->name != $selectFile)
                return;
            $fileName = "/" . trim("$dir/$repoFile->name", " /");
            $file = $this->protectedFiles()->firstOrNew([
                'path' => $fileName
            ]);
            $shaValues = is_array($file->sha_values) ? $file->sha_values : [];
            $shaValues[] = $repoFile->sha;
            $file->sha_values = array_unique($shaValues);
            $file->save();
        });
    }

    public function participants(): \Illuminate\Support\Collection
    {
        return $this->projects->reject(function (Project $project) {
            return $project->ownable_type == null;
        })->map(function (Project $project) {
            return $project->owners()->each(function (User $user) use ($project) {
                $user->project_status = $project->status;
            });
        })->flatten();
    }

    public function grade(User $user = null)
    {
        if ($user == null)
            $user = auth()->user();
        if ( $this->grades()->where('user_id', $user->id)->first() != null)
        return $this->grades()->where('user_id', $user->id)->first();
    }
}
