<?php

namespace GraphQL\SchemaObject;

class SavedReplyQueryObject extends QueryObject
{
    const OBJECT_NAME = "SavedReply";

    public function selectContent()
    {
        $this->selectField("content");

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
}
