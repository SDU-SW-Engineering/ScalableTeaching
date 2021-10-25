<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionSnapshotEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionSnapshotEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DevopsAdoptionSnapshotEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionSnapshotQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
