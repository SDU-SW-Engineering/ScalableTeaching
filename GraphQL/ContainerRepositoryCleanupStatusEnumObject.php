<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryCleanupStatusEnumObject extends EnumObject
{
    const UNSCHEDULED = "UNSCHEDULED";
    const SCHEDULED = "SCHEDULED";
    const UNFINISHED = "UNFINISHED";
    const ONGOING = "ONGOING";
}
