<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiCatalogResourceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
