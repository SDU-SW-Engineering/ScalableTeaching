<?php

namespace GraphQL\SchemaObject;

class PathLockQueryObject extends QueryObject
{
    const OBJECT_NAME = "PathLock";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectPath()
    {
        $this->selectField("path");

        return $this;
    }

    public function selectUser(PathLockUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
