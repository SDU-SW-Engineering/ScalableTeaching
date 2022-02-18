<?php

namespace GraphQL\SchemaObject;

class UserStateEnumObject extends EnumObject
{
    const ACTIVE = "active";
    const BLOCKED = "blocked";
    const DEACTIVATED = "deactivated";
}
