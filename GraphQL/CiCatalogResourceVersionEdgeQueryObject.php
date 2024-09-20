<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(CiCatalogResourceVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceVersionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
