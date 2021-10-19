<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function userGroups(User $user)
    {
        return $this->groups()
            ->with('users')
            ->whereRelation('users', 'user_id', $user->id)
            ->latest()
            ->get();
    }

    public function groupInvitations()
    {
        return $this->hasManyThrough(GroupInvitation::class, Group::class);
    }

    public function hasMaxGroups(User $user)
    {
        $currentCount = $this->userGroups($user)->count();
        // todo: switch to match statement when using php8 in production
        if ($this->max_groups == 'same_as_assignments')
            $upperLimit = $this->tasks()->count();
        else if ($this->max_groups == 'custom')
            $upperLimit = $this->max_group_size;
        else
            $upperLimit = 0;

        return $currentCount >= $upperLimit;
    }
}
