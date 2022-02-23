<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallScheduleQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallSchedule";

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectIid()
    {
        $this->selectField("iid");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectOncallUsers(IncidentManagementOncallScheduleOncallUsersArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("oncallUsers");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRotation(IncidentManagementOncallScheduleRotationArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallRotationQueryObject("rotation");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectRotations(IncidentManagementOncallScheduleRotationsArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallRotationConnectionQueryObject("rotations");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectTimezone()
    {
        $this->selectField("timezone");

        return $this;
    }
}
