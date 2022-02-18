<?php

namespace GraphQL\SchemaObject;

class PipelineScopeEnumEnumObject extends EnumObject
{
    const RUNNING = "RUNNING";
    const PENDING = "PENDING";
    const FINISHED = "FINISHED";
    const BRANCHES = "BRANCHES";
    const TAGS = "TAGS";
}
