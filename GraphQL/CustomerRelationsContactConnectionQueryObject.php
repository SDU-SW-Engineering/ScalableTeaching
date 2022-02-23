<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsContactConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsContactConnection";

    public function selectEdges(CustomerRelationsContactConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsContactEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CustomerRelationsContactConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsContactQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CustomerRelationsContactConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
