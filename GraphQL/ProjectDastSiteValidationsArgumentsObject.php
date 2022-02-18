<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectDastSiteValidationsArgumentsObject extends ArgumentsObject
{
    protected $normalizedTargetUrls;
    protected $status;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setNormalizedTargetUrls(array $normalizedTargetUrls)
    {
        $this->normalizedTargetUrls = $normalizedTargetUrls;

        return $this;
    }

    public function setStatus($dastSiteValidationStatusEnum)
    {
        $this->status = new RawObject($dastSiteValidationStatusEnum);

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
