<?php

namespace GraphQL\SchemaObject;

use GraphQL\RawObject;

class DoraMetricsArgumentsObject extends ArgumentsObject
{
    protected $metric;
    protected $startDate;
    protected $endDate;
    protected $interval;
    protected $environmentTier;

    public function setMetric($doraMetricType)
    {
        $this->metric = new RawObject($doraMetricType);

        return $this;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function setInterval($doraMetricBucketingInterval)
    {
        $this->interval = new RawObject($doraMetricBucketingInterval);

        return $this;
    }

    public function setEnvironmentTier($deploymentTier)
    {
        $this->environmentTier = new RawObject($deploymentTier);

        return $this;
    }
}
