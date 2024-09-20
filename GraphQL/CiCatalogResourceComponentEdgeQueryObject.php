<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceComponentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceComponentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiCatalogResourceComponentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceComponentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
