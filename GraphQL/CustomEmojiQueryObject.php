<?php

namespace GraphQL\SchemaObject;

class CustomEmojiQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomEmoji";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

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

    public function selectUserPermissions(CustomEmojiUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new CustomEmojiPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
