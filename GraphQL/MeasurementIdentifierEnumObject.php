<?php

namespace GraphQL\SchemaObject;

class MeasurementIdentifierEnumObject extends EnumObject
{
    const PROJECTS = "PROJECTS";
    const USERS = "USERS";
    const ISSUES = "ISSUES";
    const MERGE_REQUESTS = "MERGE_REQUESTS";
    const GROUPS = "GROUPS";
    const PIPELINES = "PIPELINES";
    const PIPELINES_SUCCEEDED = "PIPELINES_SUCCEEDED";
    const PIPELINES_FAILED = "PIPELINES_FAILED";
    const PIPELINES_CANCELED = "PIPELINES_CANCELED";
    const PIPELINES_SKIPPED = "PIPELINES_SKIPPED";
}
