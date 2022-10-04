<?php

namespace App\Models;

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
}
