<?php

namespace GraphQL\SchemaObject;

class CiRunnerStatusEnumObject extends EnumObject
{
    const ONLINE = "ONLINE";
    const STALE = "STALE";
    const NEVER_CONTACTED = "NEVER_CONTACTED";
}
