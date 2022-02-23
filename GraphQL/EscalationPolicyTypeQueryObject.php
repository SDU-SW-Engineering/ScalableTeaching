<?php

namespace GraphQL\SchemaObject;

class EscalationPolicyTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EscalationPolicyType";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectRules(EscalationPolicyTypeRulesArgumentsObject $argsObject = null)
    {
        $object = new EscalationRuleTypeQueryObject("rules");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
