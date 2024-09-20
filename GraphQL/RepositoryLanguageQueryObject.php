<?php

namespace GraphQL\SchemaObject;

class RepositoryLanguageQueryObject extends QueryObject
{
    const OBJECT_NAME = "RepositoryLanguage";

    public function selectColor()
    {
        $this->selectField("color");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectShare()
    {
        $this->selectField("share");

        return $this;
    }
}
