<?php

namespace GraphQL\SchemaObject;

class DiscussionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DiscussionConnection";

    public function selectEdges(DiscussionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DiscussionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DiscussionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DiscussionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DiscussionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
