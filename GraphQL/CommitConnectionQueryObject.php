<?php

namespace GraphQL\SchemaObject;

class CommitConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CommitConnection";

    public function selectEdges(CommitConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CommitEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CommitConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CommitConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
