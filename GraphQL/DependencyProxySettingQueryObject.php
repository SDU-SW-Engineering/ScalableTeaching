<?php

namespace GraphQL\SchemaObject;

class DependencyProxySettingQueryObject extends QueryObject
{
    const OBJECT_NAME = "DependencyProxySetting";

    public function selectEnabled()
    {
        $this->selectField("enabled");

        return $this;
    }
}
