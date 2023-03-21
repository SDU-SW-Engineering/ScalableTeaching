<?php

namespace App\Modules;

use App\Modules\LinkRepository\LinkRepository;
use App\Modules\ProtectFiles\ProtectFiles;

class Kernel
{
    public array $modules = [
        ProtectFiles::class,
        LinkRepository::class
    ];
}
