<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceVersionConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceVersionConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(CiCatalogResourceVersionConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceVersionEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiCatalogResourceVersionConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceVersionQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiCatalogResourceVersionConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
