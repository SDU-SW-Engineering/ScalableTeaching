<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @mixin \Eloquent
 *
 * @property string $guid
 * @property mixed $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read Collection|Course[] $courses
 * @property string|null $given_name
 * @property string|null $sur_name
 * @property string|null $title
 * @property bool $is_admin
 * @property bool $is_sys_admin
 * @property array|null $ad_groups
 * @property string|null $avatar
 * @property string $avatar_html
 * @property-read CourseUser $courseMembership
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'gitlab_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'remember_token',
        'is_sys_admin',
        'is_admin',
        'last_login',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'bool',
        'is_sys_admin' => 'bool',
    ];

    protected $dates = ['last_login'];

    /**
     * @return BelongsToMany<Group>
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class)
            ->using(GroupUser::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    /**
     * @return MorphMany<Project>
     */
    public function projects(): MorphMany
    {
        return $this->morphMany(Project::class, 'ownable');
    }

    public function getProjectNameAttribute(): string
    {
        return \Str::kebab($this->username);
    }

    /**
     * @return BelongsToMany<Course>
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->as(CourseUser::class)
            ->withTimestamps();
    }

    /**
     * @return HasMany<Grade>
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * @return BelongsToMany<Survey>
     */
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(Survey::class, 'survey_owners');
    }

    /**
     * @return HasMany<ProjectFeedback>
     */
    public function feedback(): HasMany
    {
        return $this->hasMany(ProjectFeedback::class);
    }

    /**
     * @return Attribute<string,null>
     */
    public function avatar(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => $attributes['avatar'] ?? 'data:image/jpeg;base64,'.base64_encode(file_get_contents(storage_path('avatar.jpg'))));
    }

    /**
     * @return Attribute<string,null>
     */
    public function avatarHtml(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->avatar == null) {
                return '<svg xmlns="http://www.w3.org/2000/svg" class="dark:text-lime-green-400 h-10 w-10" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>';
            }

            return "<img style='border-width: 2px' class='rounded-full border h-10 w-10 border-lime-green-400' src=\"$this->avatar\" alt=\"avatar\"/>";
        });
    }

    /**
     * @return Attribute<string,null>
     */
    public function shortName(): Attribute
    {
        return Attribute::make(get: function () {
            $names = collect(explode(' ', $this->name));
            $firstName = $names->first();

            return $firstName.' '.mb_convert_encoding(substr($names->last(), 0, 1), 'UTF-8', 'UTF-8').'.';
        });
    }
}
