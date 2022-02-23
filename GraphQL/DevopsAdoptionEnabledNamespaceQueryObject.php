<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionEnabledNamespaceQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionEnabledNamespace";

    public function selectDisplayNamespace(DevopsAdoptionEnabledNamespaceDisplayNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("displayNamespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLatestSnapshot(DevopsAdoptionEnabledNamespaceLatestSnapshotArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionSnapshotQueryObject("latestSnapshot");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNamespace(DevopsAdoptionEnabledNamespaceNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSnapshots(DevopsAdoptionEnabledNamespaceSnapshotsArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionSnapshotConnectionQueryObject("snapshots");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
