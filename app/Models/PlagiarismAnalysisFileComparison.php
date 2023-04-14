<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlagiarismAnalysisFileComparison extends Model
{
    use HasFactory;

    protected $casts = [
        'meta' => 'json'
    ];

    protected $fillable = [
        'project_1_id',
        'project_2_id',
        'filename_1',
        'filename_2',
        'overlap',
        'meta'
    ];

}
