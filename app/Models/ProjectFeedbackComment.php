<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class ProjectFeedbackComment extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'line', 'comment'];

    protected $hidden = ['status', 'mark_as', 'rejection_reason', 'filename'];

    protected $appends = ['time_since'];

    public function timeSince() : Attribute
    {
        return Attribute::make(get: fn() => $this->created_at->diffForHumans());
    }
}
