<?php

namespace GraphQL\SchemaObject;

class SubscriptionFutureEntryQueryObject extends QueryObject
{
    const OBJECT_NAME = "SubscriptionFutureEntry";

    public function selectCompany()
    {
        $this->selectField("company");

        return $this;
    }

    public function selectEmail()
    {
        $this->selectField("email");

        return $this;
    }

    public function selectExpiresAt()
    {
        $this->selectField("expiresAt");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectPlan()
    {
        $this->selectField("plan");

        return $this;
    }

    public function selectStartsAt()
    {
        $this->selectField("startsAt");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUsersInLicenseCount()
    {
        $this->selectField("usersInLicenseCount");

        return $this;
    }
}
