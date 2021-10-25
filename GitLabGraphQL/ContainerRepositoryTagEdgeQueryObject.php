<?php

namespace GraphQL\SchemaObject;

class ContainerRepositoryTagEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "ContainerRepositoryTagEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(ContainerRepositoryTagEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new ContainerRepositoryTagQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
