<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read CourseTrack|null $parent
 * @property-read CourseTrack[]|Collection $children
 */
class CourseTrack extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public static function booted()
    {
        static::creating(function (CourseTrack $track)
        {
            if ($track->parent_id != null)
                $track->course_id = $track->root()->course_id;

        });
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function parent() : ?BelongsTo
    {
        return $this->belongsTo(CourseTrack::class);
    }

    public function children() : HasMany
    {
        return $this->hasMany(CourseTrack::class, 'parent_id');
    }

    public function root() : CourseTrack
    {
        if ($this->parent_id == null)
            return $this;

        return $this->parent->root();
    }

    public function path()
    {
        $path = [];
        $pointer = $this;
        do
        {
            $path[] = $pointer;
            $pointer = $pointer->parent;
        }
        while($pointer != null);

        return collect($path);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'track_id');
    }

    /**
     * @return \Illuminate\Support\Collection<CourseTrack>
     */
    public function siblings() : \Illuminate\Support\Collection
    {
        if ($this->parent_id == null)
            return collect();

        return $this->parent->children->reject(fn(CourseTrack $track) => $track->id == $this->id);
    }

    public function isOn(User $user) : bool
    {
        if ($this->parent_id == null)
            return false;

        $tasks = $this->tasks()->with('projects.ownable')->get();

        $userIds = $tasks->pluck('projects')
            ->flatten()
            ->unique('id')
            ->map(fn(Project $project) => $project->owners()->pluck('id'))
            ->flatten();

        return $userIds->contains($user->id);
    }
}
