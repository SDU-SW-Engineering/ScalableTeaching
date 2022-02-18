<?php

namespace GraphQL\SchemaObject;

class RootRunnerSetupArgumentsObject extends ArgumentsObject
{
    protected $platform;
    protected $architecture;

    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    public function setArchitecture($architecture)
    {
        $this->architecture = $architecture;

        return $this;
    }
}
