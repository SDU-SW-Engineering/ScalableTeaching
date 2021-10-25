<?php

namespace GraphQL\SchemaObject;

class EscalationRuleTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "EscalationRuleType";

    public function selectElapsedTimeSeconds()
    {
        $this->selectField("elapsedTimeSeconds");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectOncallSchedule(EscalationRuleTypeOncallScheduleArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallScheduleQueryObject("oncallSchedule");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectUser(EscalationRuleTypeUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
