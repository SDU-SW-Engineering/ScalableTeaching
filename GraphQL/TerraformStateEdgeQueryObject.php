<?php

namespace GraphQL\SchemaObject;

class TerraformStateEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformStateEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TerraformStateEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
