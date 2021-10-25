<?php

namespace GraphQL\SchemaObject;

class TestReportEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestReportEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TestReportEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TestReportQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
