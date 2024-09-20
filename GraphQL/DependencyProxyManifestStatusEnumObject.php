<?php

namespace GraphQL\SchemaObject;

class DependencyProxyManifestStatusEnumObject extends EnumObject
{
    const DEFAULT = "DEFAULT";
    const PENDING_DESTRUCTION = "PENDING_DESTRUCTION";
    const PROCESSING = "PROCESSING";
    const ERROR = "ERROR";
}
