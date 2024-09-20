<?php

namespace GraphQL\SchemaObject;

class TimelogQueryObject extends QueryObject
{
    const OBJECT_NAME = "Timelog";

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectIssue(TimelogIssueArgumentsObject $argsObject = null)
    {
        $object = new IssueQueryObject("issue");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectMergeRequest(TimelogMergeRequestArgumentsObject $argsObject = null)
    {
        $object = new MergeRequestQueryObject("mergeRequest");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectNote(TimelogNoteArgumentsObject $argsObject = null)
    {
        $object = new NoteQueryObject("note");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectProject(TimelogProjectArgumentsObject $argsObject = null)
    {
        $object = new ProjectQueryObject("project");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectSpentAt()
    {
        $this->selectField("spentAt");

        return $this;
    }

    public function selectSummary()
    {
        $this->selectField("summary");

        return $this;
    }

    public function selectTimeSpent()
    {
        $this->selectField("timeSpent");

        return $this;
    }

    public function selectUser(TimelogUserArgumentsObject $argsObject = null)
    {
        $object = new UserCoreQueryObject("user");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }

    public function selectUserPermissions(TimelogUserPermissionsArgumentsObject $argsObject = null)
    {
        $object = new TimelogPermissionsQueryObject("userPermissions");
        if ($argsObject !== null) {
            $object->appendArguments($argsObject->toArray());
        }
        $this->selectField($object);

        return $object;
    }
}
