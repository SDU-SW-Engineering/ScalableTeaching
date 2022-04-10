<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $author
 */
class ProjectSubTaskComment extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'text', 'sub_task_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
