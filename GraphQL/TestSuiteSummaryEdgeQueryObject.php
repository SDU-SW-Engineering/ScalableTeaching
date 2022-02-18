<?php

namespace GraphQL\SchemaObject;

class TestSuiteSummaryEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestSuiteSummaryEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TestSuiteSummaryEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TestSuiteSummaryQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
