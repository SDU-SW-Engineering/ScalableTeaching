<?php

namespace GraphQL\SchemaObject;

class NestedEnvironmentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "NestedEnvironmentConnection";

    public function selectEdges(NestedEnvironmentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new NestedEnvironmentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(NestedEnvironmentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new NestedEnvironmentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(NestedEnvironmentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
