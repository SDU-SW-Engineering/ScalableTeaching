<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationAnalyzersEntityConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationAnalyzersEntityConnection";

    public function selectEdges(SastCiConfigurationAnalyzersEntityConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationAnalyzersEntityEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SastCiConfigurationAnalyzersEntityConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationAnalyzersEntityQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SastCiConfigurationAnalyzersEntityConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
