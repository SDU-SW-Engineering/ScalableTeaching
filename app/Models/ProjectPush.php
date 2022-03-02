<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPush extends Model
{
    use HasFactory;

    protected $fillable = ['before_sha', 'after_sha', 'ref', 'username'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
