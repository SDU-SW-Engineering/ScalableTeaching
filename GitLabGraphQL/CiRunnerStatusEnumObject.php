<?php

namespace GraphQL\SchemaObject;

class CiRunnerStatusEnumObject extends EnumObject
{
    const ACTIVE = "ACTIVE";
    const PAUSED = "PAUSED";
    const ONLINE = "ONLINE";
    const OFFLINE = "OFFLINE";
    const NOT_CONNECTED = "NOT_CONNECTED";
}
