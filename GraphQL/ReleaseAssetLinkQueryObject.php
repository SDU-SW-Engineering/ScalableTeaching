<?php

namespace GraphQL\SchemaObject;

class ReleaseAssetLinkQueryObject extends QueryObject
{
    const OBJECT_NAME = "ReleaseAssetLink";

    public function selectDirectAssetPath()
    {
        $this->selectField("directAssetPath");

        return $this;
    }

    public function selectDirectAssetUrl()
    {
        $this->selectField("directAssetUrl");

        return $this;
    }

    public function selectExternal()
    {
        $this->selectField("external");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLinkType()
    {
        $this->selectField("linkType");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectUrl()
    {
        $this->selectField("url");

        return $this;
    }
}
