<?php

namespace GraphQL\SchemaObject;

class CustomEmojiQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomEmoji";

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
