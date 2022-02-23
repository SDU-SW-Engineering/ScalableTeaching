<?php

namespace GraphQL\SchemaObject;

class MergeRequestStateEnumObject extends EnumObject
{
    const OPENED = "opened";
    const CLOSED = "closed";
    const LOCKED = "locked";
    const ALL = "all";
    const MERGED = "merged";
}
