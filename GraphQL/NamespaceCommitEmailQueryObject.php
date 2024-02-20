<?php

namespace GraphQL\SchemaObject;

class NamespaceCommitEmailQueryObject extends QueryObject
{
    const OBJECT_NAME = "NamespaceCommitEmail";

    public function selectCreatedAt()
    {
        $this->selectField("createdAt");

        return $this;
    }

    public function selectEmail(NamespaceCommitEmailEmailArgumentsObject $argsObject = null)
    {
        $object = new EmailQueryObject("email");
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

    public function selectNamespace(NamespaceCommitEmailNamespaceArgumentsObject $argsObject = null)
    {
        $object = new NamespaceQueryObject("namespace");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUpdatedAt()
    {
        $this->selectField("updatedAt");

        return $this;
    }
}
