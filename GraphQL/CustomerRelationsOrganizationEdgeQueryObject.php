<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsOrganizationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsOrganizationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CustomerRelationsOrganizationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsOrganizationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
