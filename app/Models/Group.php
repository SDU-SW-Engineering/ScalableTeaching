<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

/**
 * @property-read Collection<int,User> $members
 * @property-read Course $course
 */
class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany<User>
     */
    public function members() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(GroupUser::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    /**
     * @return HasMany<GroupInvitation>
     */
    public function invitations() : HasMany
    {
        return $this->hasMany(GroupInvitation::class);
    }

    /**
     * @return BelongsTo<Course,Group>
     */
    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return MorphMany<Project>
     */
    public function projects() : MorphMany
    {
        return $this->morphMany(Project::class, 'ownable');
    }

    /**
     * @return Attribute<String,null>
     */
    public function projectName() : Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => Str::kebab($attributes['name']));
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasMember(User $user) : bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }

    /**
     * @return Attribute<string,null>
     */
    public function memberString() : Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => $this->members()->pluck('name')->sort()->join(', '));
    }
}
