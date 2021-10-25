<?php

namespace GraphQL\SchemaObject;

class MergeRequestSortEnumObject extends EnumObject
{
    const UPDATED_DESC = "UPDATED_DESC";
    const UPDATED_ASC = "UPDATED_ASC";
    const CREATED_DESC = "CREATED_DESC";
    const CREATED_ASC = "CREATED_ASC";
    const PRIORITY_ASC = "PRIORITY_ASC";
    const PRIORITY_DESC = "PRIORITY_DESC";
    const LABEL_PRIORITY_ASC = "LABEL_PRIORITY_ASC";
    const LABEL_PRIORITY_DESC = "LABEL_PRIORITY_DESC";
    const MILESTONE_DUE_ASC = "MILESTONE_DUE_ASC";
    const MILESTONE_DUE_DESC = "MILESTONE_DUE_DESC";
    const MERGED_AT_ASC = "MERGED_AT_ASC";
    const MERGED_AT_DESC = "MERGED_AT_DESC";
    const CLOSED_AT_ASC = "CLOSED_AT_ASC";
    const CLOSED_AT_DESC = "CLOSED_AT_DESC";
}
