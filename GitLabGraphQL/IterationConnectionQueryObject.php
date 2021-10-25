<?php

namespace GraphQL\SchemaObject;

class IterationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "IterationConnection";

    public function selectEdges(IterationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new IterationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(IterationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new IterationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(IterationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
