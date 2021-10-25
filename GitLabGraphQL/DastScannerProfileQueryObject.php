<?php

namespace GraphQL\SchemaObject;

class DastScannerProfileQueryObject extends QueryObject
{
    const OBJECT_NAME = "DastScannerProfile";

    public function selectEditPath()
    {
        $this->selectField("editPath");

        return $this;
    }

    public function selectId()
    {
        $this->selectField("id");

        return $this;
    }

    public function selectProfileName()
    {
        $this->selectField("profileName");

        return $this;
    }

    public function selectReferencedInSecurityPolicies()
    {
        $this->selectField("referencedInSecurityPolicies");

        return $this;
    }

    public function selectScanType()
    {
        $this->selectField("scanType");

        return $this;
    }

    public function selectShowDebugMessages()
    {
        $this->selectField("showDebugMessages");

        return $this;
    }

    public function selectSpiderTimeout()
    {
        $this->selectField("spiderTimeout");

        return $this;
    }

    public function selectTargetTimeout()
    {
        $this->selectField("targetTimeout");

        return $this;
    }

    public function selectUseAjaxSpider()
    {
        $this->selectField("useAjaxSpider");

        return $this;
    }
}
