<?php

namespace GraphQL\SchemaObject;

class IssuableStateEnumObject extends EnumObject
{
    const OPENED = "opened";
    const CLOSED = "closed";
    const LOCKED = "locked";
    const ALL = "all";
}
