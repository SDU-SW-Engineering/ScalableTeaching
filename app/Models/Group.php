<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GroupUser::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    public function invitations()
    {
        return $this->hasMany(GroupInvitation::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function projects()
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
