<?php

namespace GraphQL\SchemaObject;

class GroupMemberRelationEnumObject extends EnumObject
{
    const DIRECT = "DIRECT";
    const INHERITED = "INHERITED";
    const DESCENDANTS = "DESCENDANTS";
    const SHARED_FROM_GROUPS = "SHARED_FROM_GROUPS";
}
