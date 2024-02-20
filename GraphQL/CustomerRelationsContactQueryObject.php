<?php

namespace GraphQL\SchemaObject;

class CustomerRelationsContactQueryObject extends QueryObject
{
    const OBJECT_NAME = "CustomerRelationsContact";

    public function selectActive()
    {
        $this->selectField("active");

        return $this;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectDescription()
    {
        $this->selectField("description");

        return $this;
    }

    public function selectEmail()
    {
        $this->selectField("email");

        return $this;
    }

    public function selectFirstName()
    {
        $this->selectField("firstName");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectLastName()
    {
        $this->selectField("lastName");

        return $this;
    }

    public function selectOrganization(CustomerRelationsContactOrganizationArgumentsObject $argsObject = null)
    {
        $object = new CustomerRelationsOrganizationQueryObject("organization");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectPhone()
    {
        $this->selectField("phone");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
