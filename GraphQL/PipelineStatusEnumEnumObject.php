<?php

namespace GraphQL\SchemaObject;

class PipelineStatusEnumEnumObject extends EnumObject
{
    const CREATED = "CREATED";
    const WAITING_FOR_RESOURCE = "WAITING_FOR_RESOURCE";
    const PREPARING = "PREPARING";
    const WAITING_FOR_CALLBACK = "WAITING_FOR_CALLBACK";
    const PENDING = "PENDING";
    const RUNNING = "RUNNING";
    const FAILED = "FAILED";
    const SUCCESS = "SUCCESS";
    const CANCELED = "CANCELED";
    const SKIPPED = "SKIPPED";
    const MANUAL = "MANUAL";
    const SCHEDULED = "SCHEDULED";
}
