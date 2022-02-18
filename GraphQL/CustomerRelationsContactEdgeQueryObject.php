<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsContactEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsContactEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CustomerRelationsContactEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsContactQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
