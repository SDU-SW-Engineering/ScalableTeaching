<?php

namespace GraphQL\SchemaObject;

class TimeTrackingTimelogCategoryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TimeTrackingTimelogCategory";

    public function selectBillable()
    {
        $this->selectField("billable");

        return $this;
    }

    public function selectBillingRate()
    {
        $this->selectField("billingRate");

        return $this;
    }

    public function selectColor()
    {
        $this->selectField("color");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
