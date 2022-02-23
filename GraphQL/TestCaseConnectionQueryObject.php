<?php

namespace GraphQL\SchemaObject;

class TestCaseConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestCaseConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(TestCaseConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TestCaseEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TestCaseConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TestCaseQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TestCaseConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
