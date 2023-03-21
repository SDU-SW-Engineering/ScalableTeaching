<?php

namespace App\Modules\ProtectFiles;

use App\Modules\LinkRepository\LinkRepository;
use App\Modules\Module;

class ProtectFiles extends Module
{
    protected array $dependencies = [
        LinkRepository::class
    ];

    protected string $name = "Protect Files";

    protected string $description = "Specify which files are not allowed to be edited by
                            students. Altering selected files causes hand-ins to be rejected.";

    protected string $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-6 h-6 text-lime-green-300">
                                <path fill-rule="evenodd"
                                      d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                      clip-rule="evenodd"/>
                            </svg>';
}
