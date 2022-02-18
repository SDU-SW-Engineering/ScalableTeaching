<?php

namespace GraphQL\SchemaObject;

class TodoConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TodoConnection";

    public function selectEdges(TodoConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TodoEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TodoConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TodoQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TodoConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
