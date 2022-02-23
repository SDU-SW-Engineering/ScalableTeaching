<?php

namespace GraphQL\SchemaObject;

class KasQueryObject extends QueryObject
{
    const OBJECT_NAME = "Kas";

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }

    public function selectVersion()
    {
        $this->selectField("version");

        return $this;
    }
}
