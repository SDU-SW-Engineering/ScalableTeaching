<?php

namespace GraphQL\SchemaObject;

class CustomEmojiEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomEmojiEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CustomEmojiEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CustomEmojiQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
