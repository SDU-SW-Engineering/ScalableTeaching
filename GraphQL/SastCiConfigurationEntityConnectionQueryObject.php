<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationEntityConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationEntityConnection";

    public function selectEdges(SastCiConfigurationEntityConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SastCiConfigurationEntityConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationEntityQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SastCiConfigurationEntityConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
