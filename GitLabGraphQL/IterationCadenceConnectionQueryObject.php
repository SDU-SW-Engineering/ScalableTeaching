<?php

namespace GraphQL\SchemaObject;

class IterationCadenceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IterationCadenceConnection";

    public function selectEdges(IterationCadenceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IterationCadenceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IterationCadenceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IterationCadenceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
