<?php

namespace GraphQL\SchemaObject;

class SentryErrorStatusEnumObject extends EnumObject
{
    const RESOLVED = "RESOLVED";
    const RESOLVED_IN_NEXT_RELEASE = "RESOLVED_IN_NEXT_RELEASE";
    const UNRESOLVED = "UNRESOLVED";
    const IGNORED = "IGNORED";
}
