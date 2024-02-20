<?php

namespace GraphQL\SchemaObject;

class MilestoneSortEnumObject extends EnumObject
{
    const DUE_DATE_ASC = "DUE_DATE_ASC";
    const DUE_DATE_DESC = "DUE_DATE_DESC";
    const EXPIRED_LAST_DUE_DATE_ASC = "EXPIRED_LAST_DUE_DATE_ASC";
    const EXPIRED_LAST_DUE_DATE_DESC = "EXPIRED_LAST_DUE_DATE_DESC";
    const UPDATED_DESC = "UPDATED_DESC";
    const UPDATED_ASC = "UPDATED_ASC";
    const CREATED_DESC = "CREATED_DESC";
    const CREATED_ASC = "CREATED_ASC";
}
