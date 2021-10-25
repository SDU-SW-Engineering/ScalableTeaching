<?php

namespace GraphQL\SchemaObject;

class ProjectIterationCadencesArgumentsObject extends ArgumentsObject
{
    protected $id;
    protected $title;
    protected $durationInWeeks;
    protected $automatic;
    protected $active;
    protected $includeAncestorGroups;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setDurationInWeeks($durationInWeeks)
    {
        $this->durationInWeeks = $durationInWeeks;

        return $this;
    }

    public function setAutomatic($automatic)
    {
        $this->automatic = $automatic;

        return $this;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function setIncludeAncestorGroups($includeAncestorGroups)
    {
        $this->includeAncestorGroups = $includeAncestorGroups;

        return $this;
    }

    public function setAfter($after)
    {
        $this->after = $after;

        return $this;
    }

    public function setBefore($before)
    {
        $this->before = $before;

        return $this;
    }

    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}
