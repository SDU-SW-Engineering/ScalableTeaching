<?php

namespace GraphQL\SchemaObject;

class SentryErrorStackTraceEntryQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorStackTraceEntry";

    public function selectCol()
    {
        $this->selectField("col");

        return $this;
    }

    public function selectFileName()
    {
        $this->selectField("fileName");

        return $this;
    }

    public function selectFunction()
    {
        $this->selectField("function");

        return $this;
    }

    public function selectLine()
    {
        $this->selectField("line");

        return $this;
    }

    public function selectTraceContext(SentryErrorStackTraceEntryTraceContextArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorStackTraceContextQueryObject("traceContext");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
