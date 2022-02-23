<?php

namespace GraphQL\SchemaObject;

class DastSiteProfileEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastSiteProfileEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(DastSiteProfileEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new DastSiteProfileQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
