<?php

namespace GraphQL\SchemaObject;

class DastProfileScheduleQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastProfileSchedule";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectCadence(DastProfileScheduleCadenceArgumentsObject $argsObject = null)
    {
        $object = new DastProfileCadenceQueryObject("cadence");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectNextRunAt()
    {
        $this->selectField("nextRunAt");

        return $this;
    }

    public function selectOwnerValid()
    {
        $this->selectField("ownerValid");

        return $this;
    }

    public function selectStartsAt()
    {
        $this->selectField("startsAt");

        return $this;
    }

    public function selectTimezone()
    {
        $this->selectField("timezone");

        return $this;
    }
}
