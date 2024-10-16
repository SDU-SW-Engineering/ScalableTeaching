<?php

namespace GraphQL\SchemaObject;

class DetailedMergeStatusEnumObject extends EnumObject
{
    const UNCHECKED = "UNCHECKED";
    const CHECKING = "CHECKING";
    const MERGEABLE = "MERGEABLE";
    const BROKEN_STATUS = "BROKEN_STATUS";
    const COMMITS_STATUS = "COMMITS_STATUS";
    const CI_MUST_PASS = "CI_MUST_PASS";
    const CI_STILL_RUNNING = "CI_STILL_RUNNING";
    const DISCUSSIONS_NOT_RESOLVED = "DISCUSSIONS_NOT_RESOLVED";
    const DRAFT_STATUS = "DRAFT_STATUS";
    const NOT_OPEN = "NOT_OPEN";
    const NOT_APPROVED = "NOT_APPROVED";
    const BLOCKED_STATUS = "BLOCKED_STATUS";
    const POLICIES_DENIED = "POLICIES_DENIED";
    const EXTERNAL_STATUS_CHECKS = "EXTERNAL_STATUS_CHECKS";
    const PREPARING = "PREPARING";
    const JIRA_ASSOCIATION = "JIRA_ASSOCIATION";
}
