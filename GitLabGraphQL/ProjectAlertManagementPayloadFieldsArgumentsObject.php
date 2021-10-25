<?php

namespace GraphQL\SchemaObject;

class ProjectAlertManagementPayloadFieldsArgumentsObject extends ArgumentsObject
{
    protected $payloadExample;

    public function setPayloadExample($payloadExample)
    {
        $this->payloadExample = $payloadExample;

        return $this;
    }
}
