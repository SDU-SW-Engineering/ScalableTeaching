<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(GroupUser::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    public function invitations() : HasMany
    {
        return $this->hasMany(GroupInvitation::class);
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function projects() : MorphMany
    {
        return $this->morphMany(Project::class, 'ownable');
    }

    public function getProjectNameAttribute()
    {
        return \Str::kebab($this->name);
    }

    public function hasMember(User $user) : bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function getMemberStringAttribute()
    {
        return $this->users->pluck('name')->sort()->join(', ');
    }
}
