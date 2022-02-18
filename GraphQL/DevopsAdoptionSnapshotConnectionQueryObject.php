<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionSnapshotConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionSnapshotConnection";

    public function selectEdges(DevopsAdoptionSnapshotConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionSnapshotEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DevopsAdoptionSnapshotConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionSnapshotQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DevopsAdoptionSnapshotConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
