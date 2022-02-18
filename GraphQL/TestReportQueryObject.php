<?php

namespace GraphQL\SchemaObject;

class TestReportQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestReport";

    public function selectAuthor(TestReportAuthorArgumentsObject $argsObject = null)
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

    public function selectState()
    {
        $this->selectField("state");

        return $this;
    }
}
