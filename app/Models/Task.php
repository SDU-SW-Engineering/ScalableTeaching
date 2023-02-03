<?php

namespace App\Models;

use App\Models\Casts\SubTaskCollection;
use App\Models\Enums\CorrectionType;
use App\Models\Enums\TaskTypeEnum;
use App\ProjectStatus;
use Carbon\Carbon;
use Domain\SourceControl\Directory;
use Domain\SourceControl\DirectoryCollection;
use Domain\SourceControl\File;
use Domain\SourceControl\SourceControl;
use Eloquent;
use GrahamCampbell\GitLab\GitLabManager;
use GraphQL\Client;
use GraphQL\SchemaObject\RepositoryBlobsArgumentsObject;
use GraphQL\SchemaObject\RootProjectsArgumentsObject;
use GraphQL\SchemaObject\RootQueryObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @throws ModelNotFoundException<Task>
 *
 * @property CorrectionType $correction_type
 * @property int $id
 * @property string $description
 * @property string $markdown_description
 * @property string $name
 *
 * @method Task findOrFail($id, $columns = []) {
 *
 * @property SubTaskCollection $sub_tasks
 * @property-read CourseTrack|null $track
 * @property-read SurveyTask|null $pivot
 * @property-read bool $hasEnded
 * @property-read EloquentCollection|TaskDelegation[] $delegations
 * @property-read \Illuminate\Support\Collection<string,int> $totalProjectsPerDay
 * @property-read \Illuminate\Support\Collection<string,int> $totalCompletedTasksPerDay
 * @property-read EloquentCollection<TaskProtectedFile> $protectedFiles
 * @property-read TaskTypeEnum $type
 * @property-read int|null $source_project_id
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property bool $is_visible
 * @property string|null $current_sha
 * @property-read bool $is_publishable
 *
 * @mixin Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'is_visible', 'markdown_description', 'source_project_id', 'name', 'sub_tasks', 'type', 'grouped_by', 'order', 'source_project_id',
        'short_description', 'starts_at', 'ends_at', 'gitlab_group_id', 'correction_type', 'correction_tasks_required', 'correction_points_required',
        'current_sha',
    ];

    protected $dates = ['ends_at', 'starts_at'];

    protected $casts = [
        'sub_tasks' => SubTaskCollection::class,
        'correction_type' => CorrectionType::class,
        'type' => TaskTypeEnum::class,
    ];

    public function reloadDescriptionFromRepo(): bool
    {
        $gitlabManager = app(GitLabManager::class);
        $sourceControl = app(SourceControl::class);
        $root = new Directory('/');
        $directories = new Collection([$root]);
        $directoryCollection = new DirectoryCollection($directories);
        $sourceControl->getFilesFromDirectories($this->source_project_id, $directoryCollection);
        $readmeFile = $root->files->firstWhere(fn (File $file) => Str::of($file->getName())->trim()->lower() == 'readme.md');
        if ($readmeFile == null) {
            return false;
        }

        $project = $gitlabManager->projects()->show($this->source_project_id);
        $branch = $project['default_branch'];
        $readme = base64_decode($gitlabManager->repositoryFiles()->getFile($this->source_project_id, $readmeFile->getName(), $branch)['content']);
        $parseDown = new \Parsedown();
        $htmlReadme = $parseDown->parse($readme);

        $this->update([
            'description' => $htmlReadme,
            'markdown_description' => $readme,
        ]);

        return true;
    }

    // region relationships

    /**
     * @return BelongsTo<Course, Task>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return HasManyThrough<Pipeline>
     */
    public function jobs(): HasManyThrough
    {
        return $this->hasManyThrough(Pipeline::class, Project::class)->withTrashedParents();
    }

    /**
     * @return HasManyThrough<ProjectFeedback>
     */
    public function feedbacks(): HasManyThrough
    {
        return $this->hasManyThrough(ProjectFeedback::class, TaskDelegation::class);
    }

    /**
     * @return HasMany<Grade>
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * @return BelongsTo<CourseTrack,Task>|null
     */
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

    /**
     * @return HasManyThrough<ProjectPush>
     */
    public function pushes(): HasManyThrough
    {
        return $this->hasManyThrough(ProjectPush::class, Project::class);
    }

    /**
     * @return HasMany<TaskDelegation>
     */
    public function delegations(): HasMany
    {
        return $this->hasMany(TaskDelegation::class);
    }
    // endregion

    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function scopeAssignments(Builder $query): Builder
    {
        return $query->where('type', 'assignment');
    }

    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function scopeExercises(Builder $query): Builder
    {
        return $query->where('type', 'exercise');
    }

    /**
     * @param  Builder<Task>  $query
     * @return Builder<Task>
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    /**
     * @param  bool  $withTrash
     * @param  bool  $withToday
     * @return \Illuminate\Support\Collection<string,int>|null
     */
    public function dailyBuilds(bool $withTrash = false, bool $withToday = false): Collection|null
    {
        if (! $this->is_publishable) {
            return null;
        }
        $query = $this->jobs();
        if ($withTrash) {
            $query->withTrashedParents();
        }

        return $query->daily($this->starts_at->startOfDay(), $this->earliestEndDate(! $withToday))->get();
    }

    /**
     * @return HasMany<Project>
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return HasMany<TaskProtectedFile>
     */
    public function protectedFiles(): HasMany
    {
        return $this->hasMany(TaskProtectedFile::class);
    }

    /**
     * @return Attribute<\Illuminate\Support\Collection<int|string,int>,null>
     */
    public function projectsPerDay(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => $this->projects()->daily($this->starts_at, $this->earliestEndDate())->get());
    }

    /**
     * @return Attribute<\Illuminate\Support\Collection<int|string, int>|null,null>
     */
    public function totalProjectsPerDay(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => $this->is_publishable ?
            $this->projects()->daily($this->starts_at, $this->earliestEndDate())->total()
            : null);
    }

    /**
     * @return Attribute<bool, null>
     */
    public function hasEnded(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => now()->isAfter($attributes['ends_at'])
        );
    }

    /**
     * @return Attribute<\Illuminate\Support\Collection<string, int>|null,null>
     */
    public function totalCompletedTasksPerDay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->is_publishable ? $this->projects()
                ->withTrashed()
                ->where('status', 'finished')
                ->daily($this->starts_at, $this->earliestEndDate(), 'finished_at')
                ->total()
                : null
        );
    }

    /**
     * @return Attribute<bool,null>
     */
    public function isPublishable(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => filled($this->starts_at) && filled($this->ends_at) && filled($this->description));
    }

    public function earliestEndDate(bool $excludeToday = false): Carbon
    {
        return now()->isAfter($this->ends_at) ? $this->ends_at : ($excludeToday ? now()->subDay() : now());
    }

    public function currentProjectForUser(User $user): ?Project
    {
        $myGroups = $this->course->groups()
            ->whereRelation('members', 'user_id', $user->id)
            ->latest()
            ->pluck('name', 'id');
        $groupProject = $this->projects()->whereHasMorph('ownable', Group::class, function (Builder $query) use ($myGroups) {
            $query->whereIn('id', $myGroups->keys());
        })->first();

        if ($groupProject != null) {
            return $groupProject;
        }

        return $this->projects()
            ->whereHasMorph('ownable', User::class, fn (Builder $query) => $query->where('id', $user->id))
            ->first();
    }

    /**
     * @param  EloquentCollection<int,User>  $users
     * @return EloquentCollection<int,User>
     */
    public function progressStatus(EloquentCollection $users): EloquentCollection
    {
        return $users->filter(function (User $user) {
            return $this->currentProjectForUser($user) != null;
        });
    }

    /**
     * @param  EloquentCollection<int,User>  $users
     * @return EloquentCollection<int,Project>
     */
    public function projectsForUsers(EloquentCollection $users): EloquentCollection
    {
        /** @var EloquentCollection<int, Project> $projects */
        $projects = new EloquentCollection();
        $users->each(function (User $user) use ($projects) {
            $project = $this->currentProjectForUser($user);
            if ($project == null) {
                return;
            }
            $projects[] = $project;
        });

        return $projects;
    }

    /**
     * @param  Collection<int,string>  $files
     * @return void
     */
    public function loadShaValuesFromDirectory(Collection $files = new Collection()): void
    {
        if (count($files) == 0) {
            $files = $this->protectedFiles->map(fn (TaskProtectedFile $protectedFile) => $protectedFile->path);
        } // @phpstan-ignore-line
        if ($files->count() == 0) {
            return;
        }
        $directories = DirectoryCollection::fromFiles($files);
        app(SourceControl::class)->getFilesFromDirectories("$this->source_project_id", $directories);
        $relevantFiles = $directories->files()->filter(fn (File $file) => $files->contains($file->fullPath()));
        $relevantFiles->each(function (File $relevantFile) {
            $file = $this->protectedFiles()->firstOrNew([
                'path' => $relevantFile->fullPath(),
            ]);
            $shaValues = $file->sha_values ?? new Collection();
            $shaValues[] = $relevantFile->getSha();
            $file->sha_values = $shaValues->unique();
            $file->save();
        });
    }

    /**
     * @return \Illuminate\Support\Collection<int, ProjectStatus>
     */
    public function participants(): Collection
    {
        return $this->projects->reject(function (Project $project) {
            return $project->ownable_type == null;
        })->map(function (Project $project) {
            return $project->owners()->map(fn (User $user) => [
                'project_status' => $project->status,
            ]);
        })->flatten();
    }

    /**
     * @param  User|null  $user
     * @return Grade|null
     */
    public function grade(User $user = null)
    {
        if ($user == null) {
            $user = auth()->user();
        }
        if ($this->grades()->where('user_id', $user->id)->first() != null) {
            return $this->grades()->where('user_id', $user->id)->first();
        }

        return null;
    }

    /**
     * @return MorphMany<Grade>
     */
    public function sourcedGrades(): MorphMany
    {
        return $this->morphMany(Grade::class, 'source');
    }

    public function ciFile(): ?string
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
        $client = new Client(config('scalable.gitlab_url').'/api/graphql', ['Authorization' => 'Bearer '.config('scalable.gitlab_token')]);
        $files = $client->runQuery($rootObject->getQuery())->getResults()->data->projects->nodes[0]->repository->blobs->nodes; // @phpstan-ignore-line
        if (count($files) == 0) {
            return null;
        }

        return $files[0]->rawBlob;
    }

    public function canStart(Group|User $entity, string &$message = null): bool
    {
        if (! now()->isBetween($this->starts_at, $this->ends_at)) {
            $message = 'The task cannot be started outside of the task time frame';

            return false;
        }

        $groups = $entity instanceof Group ? EloquentCollection::wrap([$entity]) : $entity->groups()->where('course_id', $this->course_id)->get();
        $usersInGroups = $groups->pluck('members')
            ->flatten()
            ->unique('id');

        if ($entity instanceof User && self::usersHaveBegunTasks($entity->id, $this->id)->count() > 0) {
            $message = 'You have already started this task';

            return false;
        }

        if ($entity instanceof Group && self::usersHaveBegunTasks($usersInGroups->pluck('id'), $this->id)->count() > 0) {
            $message = 'Another user in your group have already started this task';

            return false;
        }

        if (self::groupsHaveBegunTasks($groups->pluck('id'), $this->id)->count() > 0) {
            $message = 'Your group have already started this task';

            return false;
        }

        if ($this->track_id == null) {
            return true;
        }

        $otherTrackHaveBeenPicked = $this->otherTrackHasBeenPicked(
            $entity instanceof Group
                ? collect($usersInGroups->pluck('id'))->add($entity->id)->unique()
                : collect([$entity->id]),
            $groups->pluck('id')
        );

        if ($otherTrackHaveBeenPicked) {
            $message = 'A conflicting track have already been started, and thus this task cannot be started.';

            return false;
        }

        return true;
    }

    /**
     * @param  array|int|Arrayable<int, int>  $users
     * @param  array|int|Arrayable<int, int>  $groups
     * @return bool
     */
    private function otherTrackHasBeenPicked(array|int|Arrayable $users, array|int|Arrayable $groups): bool
    {
        $siblings = $this->track->rootChildrenNotInPath(false)->pluck('id');
        $siblingTasks = Task::whereIn('track_id', $siblings)->get();

        if ($siblingTasks->count() == 0) {
            return false;
        }

        $startedUserTasks = self::usersHaveBegunTasks($users, $siblingTasks->pluck('id'));
        $startedGroupTasks = self::groupsHaveBegunTasks($groups, $siblingTasks->pluck('id'));

        return $startedUserTasks->count() > 0 || $startedGroupTasks->count() > 0;
    }

    /**
     * @param  array|int|Arrayable<int, int>  $userIds
     * @param  array|int|Arrayable<int, int>  $taskIds
     * @return EloquentCollection<int, Project>
     */
    private static function usersHaveBegunTasks(array|int|Arrayable $userIds, array|int|Arrayable $taskIds): EloquentCollection
    {
        $userIds = EloquentCollection::wrap($userIds);
        $taskIds = EloquentCollection::wrap($taskIds);

        return Project::whereIn('task_id', $taskIds)->whereHasMorph(
            'ownable',
            User::class,
            fn (Builder $query) => $query->whereIn('id', $userIds)
        )->get();
    }

    /**
     * @param  array|int|Arrayable<int, int>  $groupIds
     * @param  array|int|Arrayable<int, int>  $taskIds
     * @return EloquentCollection<int, Project>
     */
    private static function groupsHaveBegunTasks(array|int|Arrayable $groupIds, array|int|Arrayable $taskIds): EloquentCollection
    {
        $groupIds = EloquentCollection::wrap($groupIds);
        $taskIds = EloquentCollection::wrap($taskIds);

        return Project::whereIn('task_id', $taskIds)->whereHasMorph(
            'ownable',
            Group::class,
            fn (Builder $query) => $query->whereIn('id', $groupIds)
        )->get();
    }

    /**
     * @return Attribute<array<int,string>,null>
     */
    public function missingFields(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            $missing = [];
            if (! filled($attributes['description'])) {
                $missing[] = 'description';
            }
            if (! filled($attributes['starts_at'])) {
                $missing[] = 'starts at date';
            }
            if (! filled($attributes['ends_at'])) {
                $missing[] = 'ends at date';
            }

            return $missing;
        });
    }

    /**
     * @return Attribute<bool,void>
     */
    public function isVisible(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (bool) $value,
            set: function ($value, $attributes) {
                if (! $this->is_publishable) {
                    throw new \Exception('Task is not publishable.');
                }

                return $value;
            }
        );
    }

    public function loadSha(): void
    {
        $project = app(SourceControl::class)->showProject((string) $this->source_project_id);
        if ($project == null) {
            return;
        }
        $this->update(['current_sha' => $project->lastSha]);
    }

    /**
     * Key corresponds to the user id
     * Value corresponds to their associated project
     * Users that haven't created a project won't be in the dictionary
     *
     * @return EloquentCollection|\Illuminate\Support\Collection<int, int>
     */
    public function userProjectDictionary()
    {
        return $userProjects = $this->projects()->get() // @phpstan-ignore-line
            ->map(fn (Project $project) => $project->owners()->pluck('id')->mapWithKeys(fn (int $id) => [$id => $project->id]))
            ->mapWithKeys(fn ($userProject) => $userProject);
    }
}
