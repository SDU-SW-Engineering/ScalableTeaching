<?php

namespace GraphQL\SchemaObject;

class CiManualVariableConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiManualVariableConnection";

    public function selectEdges(CiManualVariableConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiManualVariableEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiManualVariableConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiManualVariableQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiManualVariableConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
