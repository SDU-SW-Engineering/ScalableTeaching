<?php

namespace GraphQL\SchemaObject;

class PagesDeploymentRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "PagesDeploymentRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(PagesDeploymentRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new PagesDeploymentRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
