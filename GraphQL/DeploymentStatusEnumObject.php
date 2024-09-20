<?php

namespace GraphQL\SchemaObject;

class DeploymentStatusEnumObject extends EnumObject
{
    const CREATED = "CREATED";
    const RUNNING = "RUNNING";
    const SUCCESS = "SUCCESS";
    const FAILED = "FAILED";
    const CANCELED = "CANCELED";
    const SKIPPED = "SKIPPED";
    const BLOCKED = "BLOCKED";
}
