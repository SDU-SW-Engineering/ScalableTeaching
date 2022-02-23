<?php

namespace GraphQL\SchemaObject;

class ProjectDastProfileArgumentsObject extends ArgumentsObject
{
    protected $hasDastProfileSchedule;
    protected $id;

    public function setHasDastProfileSchedule($hasDastProfileSchedule)
    {
        $this->hasDastProfileSchedule = $hasDastProfileSchedule;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
