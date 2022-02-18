<?php

namespace GraphQL\SchemaObject;

class DastSiteValidationEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteValidationEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DastSiteValidationEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DastSiteValidationQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
