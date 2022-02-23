<?php

namespace GraphQL\SchemaObject;

class ApprovalRuleTypeEnumObject extends EnumObject
{
    const REGULAR = "REGULAR";
    const CODE_OWNER = "CODE_OWNER";
    const REPORT_APPROVER = "REPORT_APPROVER";
    const ANY_APPROVER = "ANY_APPROVER";
}
