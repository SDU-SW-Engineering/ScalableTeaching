<?php

namespace GraphQL\SchemaObject;

class TaskCompletionStatusQueryObject extends QueryObject
{
    const OBJECT_NAME = "TaskCompletionStatus";

    public function selectCompletedCount()
    {
        $this->selectField("completedCount");

        return $this;
    }

    public function selectCount()
    {
        $this->selectField("count");

        return $this;
    }
}
