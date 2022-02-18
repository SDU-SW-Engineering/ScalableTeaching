<?php

namespace GraphQL\SchemaObject;

class SentryErrorStackTraceQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorStackTrace";

    public function selectDateReceived()
    {
        $this->selectField("dateReceived");

        return $this;
    }

    public function selectIssueId()
    {
        $this->selectField("issueId");

        return $this;
    }

    public function selectStackTraceEntries(SentryErrorStackTraceStackTraceEntriesArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorStackTraceEntryQueryObject("stackTraceEntries");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
