<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverrideGrade extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'overridden_by', 'status'];
}
