<?php

namespace GraphQL\SchemaObject;

class EgressNodeConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "EgressNodeConnection";

    public function selectEdges(EgressNodeConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new EgressNodeEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(EgressNodeConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new EgressNodeQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(EgressNodeConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
