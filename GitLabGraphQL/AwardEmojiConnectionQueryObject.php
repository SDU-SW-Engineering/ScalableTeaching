<?php

namespace GraphQL\SchemaObject;

class AwardEmojiConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "AwardEmojiConnection";

    public function selectEdges(AwardEmojiConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new AwardEmojiEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(AwardEmojiConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new AwardEmojiQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(AwardEmojiConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
