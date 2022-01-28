<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SDU\MFA\SDUUser;

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
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $guid
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGuid($value)
 * @property-read mixed $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property string|null $given_name
 * @property string|null $sur_name
 * @property string|null $title
 * @property bool $is_admin
 * @property bool $is_sys_admin
 * @property array|null $ad_groups
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGivenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSysAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitle($value)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SDUUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'guid',
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ad_groups',
        'is_sys_admin',
        'is_admin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin'          => 'bool',
        'is_sys_admin'      => 'bool'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)
            ->using(GroupUser::class)
            ->withPivot('is_owner')
            ->withTimestamps();
    }

    public function projects()
    {
        return $this->morphMany(Project::class, 'ownable');
    }

    public function getProjectNameAttribute()
    {
        return \Str::kebab($this->username);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->as(CourseUser::class)
            ->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
