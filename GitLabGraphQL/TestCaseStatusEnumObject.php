<?php

namespace GraphQL\SchemaObject;

class TestCaseStatusEnumObject extends EnumObject
{
    const ERROR = "error";
    const FAILED = "failed";
    const SUCCESS = "success";
    const SKIPPED = "skipped";
}
