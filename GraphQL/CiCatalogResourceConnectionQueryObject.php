<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(CiCatalogResourceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiCatalogResourceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiCatalogResourceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
