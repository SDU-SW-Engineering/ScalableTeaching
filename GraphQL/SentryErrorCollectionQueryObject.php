<?php

namespace GraphQL\SchemaObject;

class SentryErrorCollectionQueryObject extends QueryObject
{
    const OBJECT_NAME = "SentryErrorCollection";

    public function selectDetailedError(SentryErrorCollectionDetailedErrorArgumentsObject $argsObject = null)
    {
        $object = new SentryDetailedErrorQueryObject("detailedError");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectErrorStackTrace(SentryErrorCollectionErrorStackTraceArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorStackTraceQueryObject("errorStackTrace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectErrors(SentryErrorCollectionErrorsArgumentsObject $argsObject = null)
    {
        $object = new SentryErrorConnectionQueryObject("errors");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectExternalUrl()
    {
        $this->selectField("externalUrl");

        return $this;
    }
}
