<?php

namespace GraphQL\SchemaObject;

class DevopsAdoptionEnabledNamespaceEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DevopsAdoptionEnabledNamespaceEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DevopsAdoptionEnabledNamespaceEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DevopsAdoptionEnabledNamespaceQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
