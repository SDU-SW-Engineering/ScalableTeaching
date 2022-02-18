<?php

namespace GraphQL\SchemaObject;

class TimeframeInputObject extends InputObject
{
    protected $start;
    protected $end;

    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
}
