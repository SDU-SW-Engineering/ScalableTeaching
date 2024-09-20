<?php

namespace GraphQL\SchemaObject;

class BranchRuleEdgeQueryObject extends QueryObject
{
    const OBJECT_NAME = "BranchRuleEdge";

    public function selectCursor()
    {
        $this->selectField("cursor");

        return $this;
    }

    public function selectNode(BranchRuleEdgeNodeArgumentsObject $argsObject = null)
    {
        $object = new BranchRuleQueryObject("node");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
