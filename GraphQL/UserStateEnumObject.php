<?php

namespace GraphQL\SchemaObject;

class UserStateEnumObject extends EnumObject
{
    const ACTIVE = "active";
    const BLOCKED = "blocked";
    const DEACTIVATED = "deactivated";
    const BANNED = "banned";
    const LDAP_BLOCKED = "ldap_blocked";
    const BLOCKED_PENDING_APPROVAL = "blocked_pending_approval";
}
