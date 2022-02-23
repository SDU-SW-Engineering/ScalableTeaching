<?php

namespace GraphQL\SchemaObject;

class RegistryStateEnumObject extends EnumObject
{
    const PENDING = "PENDING";
    const STARTED = "STARTED";
    const SYNCED = "SYNCED";
    const FAILED = "FAILED";
}
