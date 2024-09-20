<?php

namespace GraphQL\SchemaObject;

class InheritedCiVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "InheritedCiVariableConnection";

    public function selectEdges(InheritedCiVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new InheritedCiVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(InheritedCiVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new InheritedCiVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(InheritedCiVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
