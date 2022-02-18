<?php

namespace GraphQL\SchemaObject;

class TerraformStateVersionRegistryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TerraformStateVersionRegistryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TerraformStateVersionRegistryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TerraformStateVersionRegistryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
