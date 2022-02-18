<?php

namespace GraphQL\SchemaObject;

class EventActionEnumObject extends EnumObject
{
    const CREATED = "CREATED";
    const UPDATED = "UPDATED";
    const CLOSED = "CLOSED";
    const REOPENED = "REOPENED";
    const PUSHED = "PUSHED";
    const COMMENTED = "COMMENTED";
    const MERGED = "MERGED";
    const JOINED = "JOINED";
    const LEFT = "LEFT";
    const DESTROYED = "DESTROYED";
    const EXPIRED = "EXPIRED";
    const APPROVED = "APPROVED";
}
