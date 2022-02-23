<?php

namespace GraphQL\SchemaObject;

class ExternalAuditEventDestinationQueryObject extends QueryObject
{
    const OBJECT_NAME = "ExternalAuditEventDestination";

    public function selectDestinationUrl()
    {
        $this->selectField("destinationUrl");

        return $this;
    }

    public function selectGroup(ExternalAuditEventDestinationGroupArgumentsObject $argsObject = null)
    {
        $object = new GroupQueryObject("group");
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

    public function selectVerificationToken()
    {
        $this->selectField("verificationToken");

        return $this;
    }
}
