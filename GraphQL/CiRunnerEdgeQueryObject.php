<?php

namespace GraphQL\SchemaObject;

class CiRunnerEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "CiRunnerEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectEditUrl()
    {
        $this->selectField("editUrl");

        return $this;
    }

    public function selectNode(CiRunnerEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new CiRunnerQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectWebUrl()
    {
        $this->selectField("webUrl");

        return $this;
    }
}
