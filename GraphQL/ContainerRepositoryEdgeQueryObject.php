<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ContainerRepositoryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
