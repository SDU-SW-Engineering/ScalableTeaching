<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property string $max_groups
 * @property int $max_group_size
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereMaxGroupSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereMaxGroups($value)
 */
class Course extends Model
{
    use HasFactory;

    // region Relationships
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }
    // endregion

    public function userGroups(User $user)
    {
        return $this->groups()
            ->with(['users', 'invitations.recipient', 'projects'])
            ->whereRelation('users', 'user_id', $user->id)
            ->latest()
            ->get();
    }

    public function groupInvitations() : HasManyThrough
    {
        return $this->hasManyThrough(GroupInvitation::class, Group::class);
    }

    public function hasMaxGroups(User $user) : bool
    {
        $currentCount = $this->userGroups($user)->count();

        $upperLimit = match ($this->max_groups)
        {
            'same_as_assignments' => $this->tasks()->count(),
            'custom'              => $this->max_groupss_amount,
            default               => 0
        };

        return $currentCount >= $upperLimit;
    }

    public function teachers() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->as(CourseUser::class)
            ->wherePivot('role', 'teacher')
            ->withTimestamps();
    }

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->as(CourseUser::class)
            ->wherePivot('role', 'student')
            ->withTimestamps();
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->as(CourseUser::class)
            ->withTimestamps();
    }

    public function hasTeacher(User $user) : bool
    {
        return $this->teachers()->where('user_id', $user->id)->exists();
    }
}
