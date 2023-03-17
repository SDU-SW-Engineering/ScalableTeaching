<?php

namespace Domain\SourceControl;

class Job
{
    public function __construct(public string $name, public string $status)
    {
    }
}
