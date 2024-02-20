<?php

namespace GraphQL\SchemaObject;

class MlModelEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModelEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MlModelEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MlModelQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
