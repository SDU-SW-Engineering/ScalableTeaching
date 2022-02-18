<?php

namespace GraphQL\SchemaObject;

class NoteableTypeUnionObject extends UnionObject
{
    public function onDesign()
    {
        $object = new DesignQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onIssue()
    {
        $object = new IssueQueryObject();
        $this->addPossibleType($object);

        return $object;
    }

    public function onMergeRequest()
    {
        $object = new MergeRequestQueryObject();
        $this->addPossibleType($object);

        return $object;
    }
}
