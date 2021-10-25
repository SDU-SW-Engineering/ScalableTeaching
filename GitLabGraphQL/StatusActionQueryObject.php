<?php

namespace GraphQL\SchemaObject;

class StatusActionQueryObject extends QueryObject
{
    const OBJECT_NAME = "StatusAction";

    public function selectButtonTitle()
    {
        $this->selectField("buttonTitle");

        return $this;
    }

    public function selectIcon()
    {
        $this->selectField("icon");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectMethod()
    {
        $this->selectField("method");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectTitle()
    {
        $this->selectField("title");

        return $this;
    }
}
