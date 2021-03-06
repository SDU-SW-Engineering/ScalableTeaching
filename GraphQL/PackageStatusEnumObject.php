<?php

namespace GraphQL\SchemaObject;

class PackageStatusEnumObject extends EnumObject
{
    const DEFAULT = "DEFAULT";
    const HIDDEN = "HIDDEN";
    const PROCESSING = "PROCESSING";
    const ERROR = "ERROR";
    const PENDING_DESTRUCTION = "PENDING_DESTRUCTION";
}
