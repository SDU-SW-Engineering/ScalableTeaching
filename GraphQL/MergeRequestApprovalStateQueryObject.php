<?php

namespace GraphQL\SchemaObject;

class MergeRequestApprovalStateQueryObject extends QueryObject
{
    const OBJECT_NAME = "MergeRequestApprovalState";

    public function selectApprovalRulesOverwritten()
    {
        $this->selectField("approvalRulesOverwritten");

        return $this;
    }

    public function selectRules(MergeRequestApprovalStateRulesArgumentsObject $argsObject = null)
    {
        $object = new ApprovalRuleQueryObject("rules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
