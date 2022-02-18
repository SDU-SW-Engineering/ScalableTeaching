<?php

namespace GraphQL\SchemaObject;

class CodeCoverageActivityConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "CodeCoverageActivityConnection";

    public function selectEdges(CodeCoverageActivityConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new CodeCoverageActivityEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(CodeCoverageActivityConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new CodeCoverageActivityQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(CodeCoverageActivityConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
