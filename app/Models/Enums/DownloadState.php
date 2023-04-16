<?php

namespace App\Models\Enums;

enum DownloadState: int
{
    case Queued = 1;
    case Downloaded = 2;
    case OnDisk = 3;
}
