<?php

namespace GraphQL\SchemaObject;

class GroupsQueryObject extends QueryObject
{
    const OBJECT_NAME = "Groups";

    public function selectCommit(GroupsCommitArgumentsObject $argsObject = null)
    {
        $object = new CommitQueryObject("commit");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectCommitData(GroupsCommitDataArgumentsObject $argsObject = null)
    {
        $object = new CommitDataQueryObject("commitData");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectLineno()
    {
        $this->selectField("lineno");

        return $this;
    }

    public function selectLines()
    {
        $this->selectField("lines");

        return $this;
    }

    public function selectSpan()
    {
        $this->selectField("span");

        return $this;
    }
}
