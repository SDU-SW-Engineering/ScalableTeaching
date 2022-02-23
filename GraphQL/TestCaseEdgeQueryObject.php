<?php

namespace GraphQL\SchemaObject;

class TestCaseEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestCaseEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(TestCaseEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new TestCaseQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
