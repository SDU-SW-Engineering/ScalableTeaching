<?php

namespace GraphQL\SchemaObject;

class IssueStateEnumObject extends EnumObject
{
    const OPENED = "opened";
    const CLOSED = "closed";
    const LOCKED = "locked";
    const ALL = "all";
}
