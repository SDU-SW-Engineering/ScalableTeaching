<?php

namespace Domain\ActivityLogging\Course;

class CourseActivityMessage
{
    public function __construct(public string $message, public int $courseId, public ?int $affectedUserId, public ?int $affectedByUserId = null, public array $additional = [])
    {

    }
}
