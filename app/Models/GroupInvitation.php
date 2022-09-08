<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\GroupInvitation
 *
 * @property int $id
 * @property int $group_id
 * @property int $recipient_user_id
 * @property int $invited_by_user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Group $group
 * @method static Builder|GroupInvitation newModelQuery()
 * @method static Builder|GroupInvitation newQuery()
 * @method static Builder|GroupInvitation query()
 * @method static Builder|GroupInvitation whereCreatedAt($value)
 * @method static Builder|GroupInvitation whereGroupId($value)
 * @method static Builder|GroupInvitation whereId($value)
 * @method static Builder|GroupInvitation whereInvitedByUserId($value)
 * @method static Builder|GroupInvitation whereRecipientUserId($value)
 * @method static Builder|GroupInvitation whereUpdatedAt($value)
 */
class GroupInvitation extends Model
{
    use HasFactory;

    protected $fillable = ['recipient_user_id', 'invited_by_user_id'];

    /**
     * @return BelongsTo<Group,GroupInvitation>
     */
    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return BelongsTo<User,GroupInvitation>
     */
    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by_user_id');
    }

    /**
     * @return BelongsTo<User,GroupInvitation>
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
}
