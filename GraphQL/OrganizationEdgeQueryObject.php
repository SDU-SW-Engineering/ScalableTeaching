<?php

namespace GraphQL\SchemaObject;

class OrganizationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(OrganizationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new OrganizationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
