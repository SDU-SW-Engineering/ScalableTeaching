<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read SurveyTask|null $pivot
 * @property-read int|null $responses_count
 * @property-read Carbon $created_at
 */
class Survey extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return HasMany<SurveyField>
     */
    public function fields(): HasMany
    {
        return $this->hasMany(SurveyField::class);
    }

    /**
     * @return HasMany<SurveyResponse>
     */
    public function responses() : HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function isAnswered(User $user, Task|int $task) : bool
    {
        return $this->responses()->task($task)->user($user)->exists();
    }

    /**
     * @return BelongsToMany<Task>
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->using(SurveyTask::class)
            ->withPivot( 'deadline')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<User>
     */
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'survey_owners');
    }
}
