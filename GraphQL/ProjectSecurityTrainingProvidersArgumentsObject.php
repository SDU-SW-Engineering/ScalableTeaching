<?php

namespace GraphQL\SchemaObject;

class ProjectSecurityTrainingProvidersArgumentsObject extends ArgumentsObject
{
    protected $onlyEnabled;

    public function setOnlyEnabled($onlyEnabled)
    {
        $this->onlyEnabled = $onlyEnabled;

        return $this;
    }
}
