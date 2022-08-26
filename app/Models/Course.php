<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

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
 * @property-read Collection|CourseRole[] $roles
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

    protected $fillable = ['max_groups_amount', 'max_groups', 'max_group_size'];
    protected $hidden = ['enroll_token'];

    // region Relationships
    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->as(CourseUser::class)
            ->withTimestamps();
    }

    public function roles()
    {
        return $this->hasMany(CourseRole::class);
    }
    // endregion

    public static function booted()
    {
        static::creating(function (Course $course) {
            $course->enroll_token = Str::random(32);
        });
    }

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
            'custom'              => $this->max_groups_amount,
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

    public function tracks() : HasMany
    {
        return $this->hasMany(CourseTrack::class);
    }

    public function hasTeacher(User $user) : bool
    {
        return $this->teachers()->where('user_id', $user->id)->exists();
    }

    public function hasUser(User $user) : bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }
}
