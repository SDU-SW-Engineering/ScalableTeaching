<?php

namespace GraphQL\SchemaObject;

class TreeEntryQueryObject extends QueryObject
{
    const OBJECT_NAME = "TreeEntry";

    public function selectFlatPath()
    {
        $this->selectField("flatPath");

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

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectWebPath()
    {
        $this->selectField("webPath");

        return $this;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
