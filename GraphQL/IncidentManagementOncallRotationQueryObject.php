<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallRotationQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallRotation";

    public function selectActivePeriod(IncidentManagementOncallRotationActivePeriodArgumentsObject $argsObject = null)
    {
        $object = new OncallRotationActivePeriodTypeQueryObject("activePeriod");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectEndsAt()
    {
        $this->selectField("endsAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLength()
    {
        $this->selectField("length");

        return $this;
    }

    public function selectLengthUnit()
    {
        $this->selectField("lengthUnit");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectParticipants(IncidentManagementOncallRotationParticipantsArgumentsObject $argsObject = null)
    {
        $object = new OncallParticipantTypeConnectionQueryObject("participants");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectShifts(IncidentManagementOncallRotationShiftsArgumentsObject $argsObject = null)
    {
        $object = new IncidentManagementOncallShiftConnectionQueryObject("shifts");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStartsAt()
    {
        $this->selectField("startsAt");

        return $this;
    }
}
