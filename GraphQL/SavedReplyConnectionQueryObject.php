<?php

namespace GraphQL\SchemaObject;

class SavedReplyConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SavedReplyConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(SavedReplyConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SavedReplyConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SavedReplyQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SavedReplyConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
