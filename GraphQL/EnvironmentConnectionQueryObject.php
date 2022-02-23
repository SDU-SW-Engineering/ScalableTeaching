<?php

namespace GraphQL\SchemaObject;

class EnvironmentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EnvironmentConnection";

    public function selectEdges(EnvironmentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EnvironmentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EnvironmentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EnvironmentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
