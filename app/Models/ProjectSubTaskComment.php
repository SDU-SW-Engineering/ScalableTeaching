<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $author
 */
class ProjectSubTaskComment extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'text', 'sub_task_id'];

    /**
     * @return BelongsTo<User,ProjectSubTaskComment>
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
