<?php

namespace GraphQL\SchemaObject;

class JobNeedUnionEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "JobNeedUnionEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(JobNeedUnionEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new JobNeedUnionUnionObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
