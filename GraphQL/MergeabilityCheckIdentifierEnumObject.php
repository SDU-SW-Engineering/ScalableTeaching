<?php

namespace GraphQL\SchemaObject;

class MergeabilityCheckIdentifierEnumObject extends EnumObject
{
    const NOT_OPEN = "NOT_OPEN";
    const DRAFT_STATUS = "DRAFT_STATUS";
    const BROKEN_STATUS = "BROKEN_STATUS";
    const COMMITS_STATUS = "COMMITS_STATUS";
    const DISCUSSIONS_NOT_RESOLVED = "DISCUSSIONS_NOT_RESOLVED";
    const CI_MUST_PASS = "CI_MUST_PASS";
    const CONFLICT = "CONFLICT";
    const NEED_REBASE = "NEED_REBASE";
}
