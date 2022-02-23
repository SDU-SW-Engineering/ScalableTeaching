<?php

namespace GraphQL\SchemaObject;

class DastSiteValidationQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteValidation";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectNormalizedTargetUrl()
    {
        $this->selectField("normalizedTargetUrl");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }
}
