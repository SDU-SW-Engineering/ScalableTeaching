<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionEnabledNamespaceConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionEnabledNamespaceConnection";

    public function selectEdges(DevopsAdoptionEnabledNamespaceConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionEnabledNamespaceEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(DevopsAdoptionEnabledNamespaceConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionEnabledNamespaceQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(DevopsAdoptionEnabledNamespaceConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
