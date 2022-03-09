<?php

namespace App\Models;

use App\Models\Enums\CorrectionType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read SurveyTask|null $pivot
 */
class Survey extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function fields(): HasMany
    {
        return $this->hasMany(SurveyField::class);
    }

    public function responses() : HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function isAnswered(User $user, Task|int $task) : bool
    {
        return $this->responses()->task($task)->user($user)->exists();
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->using(SurveyTask::class)
            ->withPivot( 'deadline')
            ->withTimestamps();
    }
}
