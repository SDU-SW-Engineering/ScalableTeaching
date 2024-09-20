<?php

namespace GraphQL\SchemaObject;

class CiRunnerStatusEnumObject extends EnumObject
{
    const ONLINE = "ONLINE";
    const OFFLINE = "OFFLINE";
    const STALE = "STALE";
    const NEVER_CONTACTED = "NEVER_CONTACTED";
}
