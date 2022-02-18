<?php

namespace GraphQL\SchemaObject;

class EventQueryObject extends QueryObject
{
    const OBJECT_NAME = "Event";

    public function selectAction()
    {
        $this->selectField("action");

        return $this;
    }

    public function selectAuthor(EventAuthorArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("author");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
