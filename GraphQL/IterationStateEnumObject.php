<?php

namespace GraphQL\SchemaObject;

class IterationStateEnumObject extends EnumObject
{
    const UPCOMING = "upcoming";
    const CURRENT = "current";
    const OPENED = "opened";
    const CLOSED = "closed";
    const ALL = "all";
}
