<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class ProjectPackagesArgumentsObject extends ArgumentsObject
{
    protected $sort;
    protected $packageName;
    protected $packageType;
    protected $status;
    protected $includeVersionless;
    protected $after;
    protected $before;
    protected $first;
    protected $last;

    public function setSort($packageSort)
    {
        $this->sort = new RawObject($packageSort);

        return $this;
    }

    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;

        return $this;
    }

    public function setPackageType($packageTypeEnum)
    {
        $this->packageType = new RawObject($packageTypeEnum);

        return $this;
    }

    public function setStatus($packageStatus)
    {
        $this->status = new RawObject($packageStatus);

        return $this;
    }

    public function setIncludeVersionless($includeVersionless)
    {
        $this->includeVersionless = $includeVersionless;

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
