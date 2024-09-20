<?php

namespace GraphQL\SchemaObject;

class MlModelVersionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "MlModelVersionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(MlModelVersionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new MlModelVersionQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
