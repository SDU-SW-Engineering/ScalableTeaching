<?php

namespace GraphQL\SchemaObject;

class ProjectMemberRelationEnumObject extends EnumObject
{
    const DIRECT = "DIRECT";
    const INHERITED = "INHERITED";
    const DESCENDANTS = "DESCENDANTS";
    const INVITED_GROUPS = "INVITED_GROUPS";
    const SHARED_INTO_ANCESTORS = "SHARED_INTO_ANCESTORS";
}
