<?php

namespace GraphQL\SchemaObject;

class RunnerSetupQueryObject extends QueryObject
{
    const OBJECT_NAME = "RunnerSetup";

    public function selectInstallInstructions()
    {
        $this->selectField("installInstructions");

        return $this;
    }

    public function selectRegisterInstructions()
    {
        $this->selectField("registerInstructions");

        return $this;
    }
}
