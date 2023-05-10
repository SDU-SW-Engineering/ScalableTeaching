<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlagiarismSuspicion extends Model
{
    use HasFactory;

    protected $fillable = ['project_1_id', 'project_2_id', 'task_id'];
}
