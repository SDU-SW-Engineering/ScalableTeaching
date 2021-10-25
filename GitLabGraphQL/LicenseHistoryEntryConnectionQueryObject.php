<?php

namespace GraphQL\SchemaObject;

class LicenseHistoryEntryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "LicenseHistoryEntryConnection";

    public function selectEdges(LicenseHistoryEntryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new LicenseHistoryEntryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(LicenseHistoryEntryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new LicenseHistoryEntryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(LicenseHistoryEntryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
