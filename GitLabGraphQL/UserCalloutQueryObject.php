<?php

namespace GraphQL\SchemaObject;

class UserCalloutQueryObject extends QueryObject
{
    const OBJECT_NAME = "UserCallout";

    public function selectDismissedAt()
    {
        $this->selectField("dismissedAt");

        return $this;
    }

    public function selectFeatureName()
    {
        $this->selectField("featureName");

        return $this;
    }
}
