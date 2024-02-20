<?php

namespace GraphQL\SchemaObject;

class OrganizationUserBadgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationUserBadge";

    public function selectText()
    {
        $this->selectField("text");

        return $this;
    }

    public function selectVariant()
    {
        $this->selectField("variant");

        return $this;
    }
}
