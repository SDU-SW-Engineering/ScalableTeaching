<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlagiarismAnalysisComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_1_id',
        'project_2_id',
        'overlap',
    ];

    protected $casts = [
        'overlap' => 'double'
    ];

}
