<?php

namespace GraphQL\SchemaObject;

class TestSuiteSummaryConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestSuiteSummaryConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(TestSuiteSummaryConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TestSuiteSummaryEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TestSuiteSummaryConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TestSuiteSummaryQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TestSuiteSummaryConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
