<?php

namespace GraphQL\SchemaObject;

class CustomEmojiPermissionsQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomEmojiPermissions";

    public function selectCreateCustomEmoji()
    {
        $this->selectField("createCustomEmoji");

        return $this;
    }

    public function selectDeleteCustomEmoji()
    {
        $this->selectField("deleteCustomEmoji");

        return $this;
    }

    public function selectReadCustomEmoji()
    {
        $this->selectField("readCustomEmoji");

        return $this;
    }
}
