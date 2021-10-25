<?php

namespace GraphQL\SchemaObject;

class PipelineAnalyticsQueryObject extends QueryObject
{
    const OBJECT_NAME = "PipelineAnalytics";

    public function selectMonthPipelinesLabels()
    {
        $this->selectField("monthPipelinesLabels");

        return $this;
    }

    public function selectMonthPipelinesSuccessful()
    {
        $this->selectField("monthPipelinesSuccessful");

        return $this;
    }

    public function selectMonthPipelinesTotals()
    {
        $this->selectField("monthPipelinesTotals");

        return $this;
    }

    public function selectPipelineTimesLabels()
    {
        $this->selectField("pipelineTimesLabels");

        return $this;
    }

    public function selectPipelineTimesValues()
    {
        $this->selectField("pipelineTimesValues");

        return $this;
    }

    public function selectWeekPipelinesLabels()
    {
        $this->selectField("weekPipelinesLabels");

        return $this;
    }

    public function selectWeekPipelinesSuccessful()
    {
        $this->selectField("weekPipelinesSuccessful");

        return $this;
    }

    public function selectWeekPipelinesTotals()
    {
        $this->selectField("weekPipelinesTotals");

        return $this;
    }

    public function selectYearPipelinesLabels()
    {
        $this->selectField("yearPipelinesLabels");

        return $this;
    }

    public function selectYearPipelinesSuccessful()
    {
        $this->selectField("yearPipelinesSuccessful");

        return $this;
    }

    public function selectYearPipelinesTotals()
    {
        $this->selectField("yearPipelinesTotals");

        return $this;
    }
}
