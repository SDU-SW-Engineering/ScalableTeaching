<?php

namespace GraphQL\SchemaObject;

class MergeRequestStateEnumObject extends EnumObject
{
    const MERGED = "merged";
    const OPENED = "opened";
    const CLOSED = "closed";
    const LOCKED = "locked";
    const ALL = "all";
}
