<?php

namespace App\Models;

use App\Models\Casts\SubTask;
use App\Models\Casts\SubTaskCollection;
use App\Models\Enums\CorrectionType;
use GrahamCampbell\GitLab\GitLabManager;
use GraphQL\Client;
use GraphQL\SchemaObject\RepositoryBlobsArgumentsObject;
use GraphQL\SchemaObject\RepositoryTreeArgumentsObject;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @throws ModelNotFoundException<Task>
 * }
 *
 * @property CorrectionType $correction_type
 * @property string $name
 * @method Task findOrFail($id, $columns = []) {
 * @property SubTaskCollection $sub_tasks
 * @property-read CourseTrack|null $track
 * @property-read SurveyTask|null $pivot
 * @property-read bool $hasEnded
 * @property-read Collection|TaskDelegation[] $delegations
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'markdown_description', 'source_project_id', 'name', 'sub_tasks',
        'short_description', 'starts_at', 'ends_at', 'gitlab_group_id', 'correction_type', 'correction_tasks_required', 'correction_points_required',
    ];

    protected $dates = ['ends_at', 'starts_at'];

    protected $casts = [
        'is_visible'      => 'bool',
        'sub_tasks'       => SubTaskCollection::class,
        'correction_type' => CorrectionType::class,
    ];

    public function reloadDescriptionFromRepo()
    {
        $gitlabManager = app(GitLabManager::class);
        $project = $gitlabManager->projects()->show($this->source_project_id);
        $branch = $project['default_branch'];
        $readme = base64_decode($gitlabManager->repositoryFiles()->getFile($this->source_project_id, 'readme.md', $branch)['content']);
        $parseDown = new \Parsedown();
        $htmlReadme = $parseDown->parse($readme);

        $this->update([
            'description'          => $htmlReadme,
            'markdown_description' => $readme,
        ]);
    }

    // region relationships
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function jobs()
    {
        return $this->hasManyThrough(Pipeline::class, Project::class)->withTrashedParents();
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function track(): ?BelongsTo
    {
        return $this->belongsTo(CourseTrack::class);
    }

    public function survey(): ?Survey
    {
        return $this->belongsToMany(Survey::class)->using(SurveyTask::class)
            ->withPivot('deadline')
            ->withTimestamps()->first();
    }

    public function pushes() : HasManyThrough
    {
        return $this->hasManyThrough(ProjectPush::class, Project::class);
    }

    public function delegations() : HasMany
    {
        return $this->hasMany(TaskDelegation::class);
    }
    // endregion

    public function scopeAssignments(Builder $query): Builder
    {
        return $query->where('type', 'assignment');
    }

    public function scopeExercises(Builder $query): Builder
    {
        return $query->where('type', 'exercise');
    }

    public function dailyBuilds(bool $withTrash = false, $withToday = false): \Illuminate\Support\Collection
    {
        $query = $this->jobs();
        if($withTrash)
            $query->withTrashedParents();

        return $query->daily($this->starts_at->startOfDay(), $this->earliestEndDate(!$withToday))->get();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function protectedFiles(): HasMany
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

    public function hasEnded() : Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => now()->isAfter($attributes['ends_at'])
        );
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
        $groupProject = $this->projects()->whereHasMorph('ownable', Group::class, function(Builder $query) use ($myGroups) {
            $query->whereIn('id', $myGroups->keys());
        })->first();

        if($groupProject != null)
            return $groupProject;

        return $this->projects()
            ->whereHasMorph('ownable', User::class, fn(Builder $query) => $query->where('id', $user->id))
            ->first();
    }

    /**
     * @param Collection $users
     * @return Collection
     */
    public function progressStatus(Collection $users): Collection
    {
        return $users->filter(function(User $user) {
            return $this->currentProjectForUser($user) != null;
        });
    }

    public function projectsForUsers(Collection $users): Collection
    {
        $projects = Collection::empty();
        $users->each(function(User $user) use ($projects) {
            $project = $this->currentProjectForUser($user);
            if($project == null)
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
        $client = new Client('https://gitlab.sdu.dk/api/graphql', ["Authorization" => 'Bearer ' . config('scalable.gitlab_token')]);
        $projects = $client->runQuery($rootObject->getQuery())->getResults()->data->projects->nodes; // @phpstan-ignore-line
        if(count($projects) == 0)
            return;

        collect($projects[0]->repository->tree->blobs->nodes)->each(function($repoFile) use ($selectFile, $dir) {
            if($selectFile != null && $repoFile->name != $selectFile)
                return;
            $fileName = "/" . trim("$dir/$repoFile->name", " /");
            $file = $this->protectedFiles()->firstOrNew([
                'path' => $fileName,
            ]);
            $shaValues = is_array($file->sha_values) ? $file->sha_values : [];
            $shaValues[] = $repoFile->sha;
            $file->sha_values = array_unique($shaValues);
            $file->save();
        });
    }

    public function participants(): \Illuminate\Support\Collection
    {
        return $this->projects->reject(function(Project $project) {
            return $project->ownable_type == null;
        })->map(function(Project $project) {
            return $project->owners()->map(fn(User $user) => [
                'project_status' => $project->status,
            ]);
        })->flatten();
    }

    public function grade(User $user = null)
    {
        if($user == null)
            $user = auth()->user();
        if($this->grades()->where('user_id', $user->id)->first() != null)
            return $this->grades()->where('user_id', $user->id)->first();
    }

    public function sourcedGrades()
    {
        return $this->morphMany(Grade::class, 'source');
    }

    public function ciFile()
    {
        $rootObject = new RootQueryObject();
        $rootObject->selectProjects((new RootProjectsArgumentsObject())
            ->setIds(["gid://gitlab/Project/$this->source_project_id"])
            ->setFirst(1))
            ->selectNodes()
            ->selectRepository()
            ->selectBlobs((new RepositoryBlobsArgumentsObject())->setPaths(['.gitlab-ci.yml']))
            ->selectNodes()
            ->selectName()
            ->selectRawBlob();
        $client = new Client(config('scalable.gitlab_url') . '/api/graphql', ["Authorization" => 'Bearer ' . config('scalable.gitlab_token')]);
        $files = $client->runQuery($rootObject->getQuery())->getResults()->data->projects->nodes[0]->repository->blobs->nodes; // @phpstan-ignore-line
        if(count($files) == 0)
            return null;

        return $files[0]->rawBlob;
    }

    public function canStart(Group | User $entity, &$message = null): bool
    {
        if(!now()->isBetween($this->starts_at, $this->ends_at))
        {
            $message = 'The task cannot be started outside of the task time frame';

            return false;
        }

        $groups = $entity instanceof Group ? Collection::wrap([$entity]) : $entity->groups()->where('course_id', $this->course_id)->get();
        $usersInGroups = $groups->pluck('users')
            ->flatten()
            ->unique('id');

        if($entity instanceof User && self::usersHaveBegunTasks($entity->id, $this->id)->count() > 0)
        {
            $message = "You have already started this task";

            return false;
        }


        if($entity instanceof Group && self::usersHaveBegunTasks($usersInGroups->pluck('id'), $this->id)->count() > 0)
        {
            $message = 'Another user in your group have already started this task';

            return false;
        }

        if(self::groupsHaveBegunTasks($groups->pluck('id'), $this->id)->count() > 0)
        {
            $message = "Your group have already started this task";

            return false;
        }

        if($this->track_id == null)
            return true;

        $otherTrackHaveBeenPicked = $this->otherTrackHasBeenPicked(
            $entity instanceof Group
                ? collect($usersInGroups->pluck('id'))->add($entity->id)->unique()
                : collect([$entity->id]),
            $groups->pluck('id')
        );

        if($otherTrackHaveBeenPicked)
        {
            $message = "A conflicting track have already been started, and thus this task cannot be started.";

            return false;
        }

        return true;
    }

    private function otherTrackHasBeenPicked($users, $groups): bool
    {
        $siblings = $this->track->rootChildrenNotInPath(false)->pluck('id');
        $siblingTasks = Task::whereIn('track_id', $siblings)->get();

        if($siblingTasks->count() == 0)
            return false;

        $startedUserTasks = self::usersHaveBegunTasks($users, $siblingTasks->pluck('id'));
        $startedGroupTasks = self::groupsHaveBegunTasks($groups, $siblingTasks->pluck('id'));

        return $startedUserTasks->count() > 0 || $startedGroupTasks->count() > 0;
    }

    private static function usersHaveBegunTasks(array|int|Arrayable $userIds, array|int|Arrayable $taskIds): Collection
    {
        $userIds = Collection::wrap($userIds);
        $taskIds = Collection::wrap($taskIds);

        return Project::whereIn('task_id', $taskIds)->whereHasMorph(
            'ownable',
            User::class,
            fn(Builder $query) => $query->whereIn('id', $userIds)
        )->get();
    }

    private static function groupsHaveBegunTasks(array|int|Arrayable $groupIds, array|int|Arrayable $taskIds): Collection
    {
        $groupIds = Collection::wrap($groupIds);
        $taskIds = Collection::wrap($taskIds);

        return Project::whereIn('task_id', $taskIds)->whereHasMorph(
            'ownable',
            Group::class,
            fn(Builder $query) => $query->whereIn('id', $groupIds)
        )->get();
    }
}
