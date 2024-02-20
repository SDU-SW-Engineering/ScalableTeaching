<?php

namespace GraphQL\SchemaObject;

class CiCatalogResourceComponentConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiCatalogResourceComponentConnection";

    public function selectEdges(CiCatalogResourceComponentConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceComponentEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CiCatalogResourceComponentConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CiCatalogResourceComponentQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CiCatalogResourceComponentConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
