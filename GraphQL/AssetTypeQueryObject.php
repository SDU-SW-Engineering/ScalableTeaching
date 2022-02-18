<?php

namespace GraphQL\SchemaObject;

class AssetTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AssetType";

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectType()
    {
        $this->selectField("type");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
