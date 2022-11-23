<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/***
 * @property int user_id
 * @property int task_id
 * @property string username
 */

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'username',
    ];
}
