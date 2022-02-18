<?php

namespace GraphQL\SchemaObject;

class AlertManagementStatusEnumObject extends EnumObject
{
    const TRIGGERED = "TRIGGERED";
    const ACKNOWLEDGED = "ACKNOWLEDGED";
    const RESOLVED = "RESOLVED";
    const IGNORED = "IGNORED";
}
