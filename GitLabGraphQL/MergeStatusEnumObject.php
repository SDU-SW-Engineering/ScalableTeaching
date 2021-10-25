<?php

namespace GraphQL\SchemaObject;

class MergeStatusEnumObject extends EnumObject
{
    const UNCHECKED = "UNCHECKED";
    const CHECKING = "CHECKING";
    const CAN_BE_MERGED = "CAN_BE_MERGED";
    const CANNOT_BE_MERGED = "CANNOT_BE_MERGED";
    const CANNOT_BE_MERGED_RECHECK = "CANNOT_BE_MERGED_RECHECK";
}
