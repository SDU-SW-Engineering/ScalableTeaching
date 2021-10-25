<?php

namespace GraphQL\SchemaObject;

class DesignVersionQueryObject extends QueryObject
{
    const OBJECT_NAME = "DesignVersion";

    public function selectAuthor(DesignVersionAuthorArgumentsObject $argsObject = null)
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

    public function selectDesignAtVersion(DesignVersionDesignAtVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionQueryObject("designAtVersion");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDesigns(DesignVersionDesignsArgumentsObject $argsObject = null)
    {
        $object = new DesignConnectionQueryObject("designs");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectDesignsAtVersion(DesignVersionDesignsAtVersionArgumentsObject $argsObject = null)
    {
        $object = new DesignAtVersionConnectionQueryObject("designsAtVersion");
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

    public function selectSha()
    {
        $this->selectField("sha");

        return $this;
    }
}
