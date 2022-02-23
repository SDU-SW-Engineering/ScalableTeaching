<?php

namespace GraphQL\SchemaObject;

class DastSiteProfileValidationStatusEnumEnumObject extends EnumObject
{
    const NONE = "NONE";
    const PENDING_VALIDATION = "PENDING_VALIDATION";
    const INPROGRESS_VALIDATION = "INPROGRESS_VALIDATION";
    const PASSED_VALIDATION = "PASSED_VALIDATION";
    const FAILED_VALIDATION = "FAILED_VALIDATION";
}
