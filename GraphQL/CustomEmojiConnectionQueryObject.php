<?php

namespace GraphQL\SchemaObject;

class CustomEmojiConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomEmojiConnection";

    public function selectEdges(CustomEmojiConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CustomEmojiEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CustomEmojiConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CustomEmojiQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CustomEmojiConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
