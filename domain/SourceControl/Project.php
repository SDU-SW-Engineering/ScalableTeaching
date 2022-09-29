<?php

namespace Domain\SourceControl;

class Project
{
    public function __construct(public int|string $id)
    {
    }

    public string $lastSha;

    public string $cloneUrl;
}
