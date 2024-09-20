<?php

namespace GraphQL\SchemaObject;

class BranchRuleConnectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "BranchRuleConnection";

    public function selectEdges(BranchRuleConnectionEdgesArgumentsObject $argsObject = null)
    {
        $object = new BranchRuleEdgeQueryObject("edges");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNodes(BranchRuleConnectionNodesArgumentsObject $argsObject = null)
    {
        $object = new BranchRuleQueryObject("nodes");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPageInfo(BranchRuleConnectionPageInfoArgumentsObject $argsObject = null)
    {
        $object = new PageInfoQueryObject("pageInfo");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
