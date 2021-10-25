<?php

namespace GraphQL\SchemaObject;

class TestReportConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestReportConnection";

    public function selectEdges(TestReportConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new TestReportEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(TestReportConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new TestReportQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(TestReportConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
