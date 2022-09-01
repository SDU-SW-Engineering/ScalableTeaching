<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProtectedFile extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    protected $casts = ['sha_values' => 'array'];

    public function getBaseNameAttribute() : string
    {
        return pathinfo($this->path)['basename'];
    }

    public function getDirectoryAttribute() : string
    {
        $directory = pathinfo($this->path)['dirname'];
        if ($directory == "\\")
            $directory = "/";

        return $directory;
    }
}
