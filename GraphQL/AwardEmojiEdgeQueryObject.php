<?php

namespace GraphQL\SchemaObject;

class AwardEmojiEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardEmojiEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(AwardEmojiEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new AwardEmojiQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
