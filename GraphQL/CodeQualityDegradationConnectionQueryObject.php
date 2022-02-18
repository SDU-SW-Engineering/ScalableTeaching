<?php

namespace GraphQL\SchemaObject;

class CodeQualityDegradationConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeQualityDegradationConnection";

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }

    public function selectEdges(CodeQualityDegradationConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CodeQualityDegradationEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CodeQualityDegradationConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CodeQualityDegradationQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CodeQualityDegradationConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
