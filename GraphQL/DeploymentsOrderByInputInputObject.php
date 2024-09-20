<?php

namespace GraphQL\SchemaObject;

class DeploymentsOrderByInputInputObject extends InputObject
{
    protected $createdAt;
    protected $finishedAt;

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }
}
