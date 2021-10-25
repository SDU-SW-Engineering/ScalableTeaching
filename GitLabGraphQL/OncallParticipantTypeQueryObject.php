<?php

namespace GraphQL\SchemaObject;

class OncallParticipantTypeQueryObject extends QueryObject
{
    const OBJECT_NAME = "OncallParticipantType";

    public function selectColorPalette()
    {
        $this->selectField("colorPalette");

        return $this;
    }

    public function selectColorWeight()
    {
        $this->selectField("colorWeight");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectUser(OncallParticipantTypeUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
