<?php

namespace GraphQL\SchemaObject;

class CiJobStatusEnumObject extends EnumObject
{
    const CREATED = "CREATED";
    const WAITING_FOR_RESOURCE = "WAITING_FOR_RESOURCE";
    const PREPARING = "PREPARING";
    const PENDING = "PENDING";
    const RUNNING = "RUNNING";
    const SUCCESS = "SUCCESS";
    const FAILED = "FAILED";
    const CANCELED = "CANCELED";
    const SKIPPED = "SKIPPED";
    const MANUAL = "MANUAL";
    const SCHEDULED = "SCHEDULED";
}
