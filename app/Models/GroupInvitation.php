<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GroupInvitation
 *
 * @property int $id
 * @property int $group_id
 * @property int $recipient_user_id
 * @property int $invited_by_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereInvitedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereRecipientUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupInvitation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GroupInvitation extends Model
{
    use HasFactory;

    protected $fillable = ['recipient_user_id', 'invited_by_user_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by_user_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
}
