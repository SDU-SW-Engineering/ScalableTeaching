<?php

namespace GraphQL\SchemaObject;

class SentryErrorTagsQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorTags";

    public function selectLevel()
    {
        $this->selectField("level");

        return $this;
    }

    public function selectLogger()
    {
        $this->selectField("logger");

        return $this;
    }
}
