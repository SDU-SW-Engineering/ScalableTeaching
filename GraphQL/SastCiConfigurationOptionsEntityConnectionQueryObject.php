<?php

namespace GraphQL\SchemaObject;

class SastCiConfigurationOptionsEntityConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SastCiConfigurationOptionsEntityConnection";

    public function selectEdges(SastCiConfigurationOptionsEntityConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationOptionsEntityEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(SastCiConfigurationOptionsEntityConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new SastCiConfigurationOptionsEntityQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(SastCiConfigurationOptionsEntityConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
