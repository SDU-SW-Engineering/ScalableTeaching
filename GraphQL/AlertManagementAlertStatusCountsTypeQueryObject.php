<?php

namespace GraphQL\SchemaObject;

class AlertManagementAlertStatusCountsTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AlertManagementAlertStatusCountsType";

    public function selectAcknowledged()
    {
        $this->selectField("acknowledged");

        return $this;
    }

    public function selectAll()
    {
        $this->selectField("all");

        return $this;
    }

    public function selectIgnored()
    {
        $this->selectField("ignored");

        return $this;
    }

    public function selectOpen()
    {
        $this->selectField("open");

        return $this;
    }

    public function selectResolved()
    {
        $this->selectField("resolved");

        return $this;
    }

    public function selectTriggered()
    {
        $this->selectField("triggered");

        return $this;
    }
}
