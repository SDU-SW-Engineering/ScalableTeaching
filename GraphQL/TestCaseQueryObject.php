<?php

namespace GraphQL\SchemaObject;

class TestCaseQueryObject extends QueryObject
{
    const OBJECT_NAME = "TestCase";

    public function selectAttachmentUrl()
    {
        $this->selectField("attachmentUrl");

        return $this;
    }

    public function selectClassname()
    {
        $this->selectField("classname");

        return $this;
    }

    public function selectExecutionTime()
    {
        $this->selectField("executionTime");

        return $this;
    }

    public function selectFile()
    {
        $this->selectField("file");

        return $this;
    }

    public function selectName()
    {
        $this->selectField("name");

        return $this;
    }

    public function selectRecentFailures(TestCaseRecentFailuresArgumentsObject $argsObject = null)
    {
        $object = new RecentFailuresQueryObject("recentFailures");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectStackTrace()
    {
        $this->selectField("stackTrace");

        return $this;
    }

    public function selectStatus()
    {
        $this->selectField("status");

        return $this;
    }

    public function selectSystemOutput()
    {
        $this->selectField("systemOutput");

        return $this;
    }
}
