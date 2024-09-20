<?php

namespace GraphQL\SchemaObject;

class DeploymentEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DeploymentEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DeploymentEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DeploymentQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
