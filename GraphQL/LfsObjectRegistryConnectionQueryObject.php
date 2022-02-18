<?php

namespace GraphQL\SchemaObject;

class LfsObjectRegistryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LfsObjectRegistryConnection";

    public function selectEdges(LfsObjectRegistryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LfsObjectRegistryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(LfsObjectRegistryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new LfsObjectRegistryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LfsObjectRegistryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
