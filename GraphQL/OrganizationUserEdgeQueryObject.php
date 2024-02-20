<?php

namespace GraphQL\SchemaObject;

class OrganizationUserEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OrganizationUserEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(OrganizationUserEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new OrganizationUserQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
