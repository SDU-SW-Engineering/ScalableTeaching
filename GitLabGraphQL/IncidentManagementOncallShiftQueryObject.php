<?php

namespace GraphQL\SchemaObject;

class IncidentManagementOncallShiftQueryObject extends QueryObject
{
    const OBJECT_NAME = "IncidentManagementOncallShift";

    public function selectEndsAt()
    {
        $this->selectField("endsAt");

        return $this;
    }

    public function selectParticipant(IncidentManagementOncallShiftParticipantArgumentsObject $argsObject = null)
    {
        $object = new OncallParticipantTypeQueryObject("participant");
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
